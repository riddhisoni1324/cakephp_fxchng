<?php
include_once('../Plugin/sms_engine/sms.php');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class CategoriesController extends AppController {

	public $uses = array('ItemCategory', 'Brand', 'Role', 'AutoModel', 'AdPost', 'ItemPhoto', 'ItemType', 'SetAdReply');
	public $helpers = array('Html', 'Js', 'Form');

	public function beforeFilter() {

	AppController::beforeFilter();

		$this->Auth->allow('make_an_offer','index', "index_ajax", "product_detail", 'sub_category_items', 'sub_category_items_ajax', 'get_type_filter_data', 'get_category_filter_data', 'set_ad_reply', 'get_help', 'set_common_friends');

		// set datasource
		$this->AdPost->setDataSource('cloudant_db');

		// Set the overall layout
		$this->layout = 'main';

		// set title
		$title = "Categories";
     	$this->set('title_for_layout',$title);
	}

	// displays items by item types
	public function index($id = null) {

		// set page for infinite scroll
	 	$this->set('page',1);
	 	$limit = 5;

		if ($this->location != null) {

        	$find_result = 'by_city:"'.$this->location.'"%20AND%20'. 'item_type_id:"'.$id.'"';
        }
        else {
        	$find_result = 'item_type_id:"'.$id.'"';
        }


		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true&limit='.$limit);

		// $this->set('items' ,$items['rows']);
		$this->set('id' , $id);

		// set breadcrumb
		$item_type = $this->ItemType->find('first', array('conditions' => array('id' => $id), 'fields' => array('id', 'name')));
		$this->set('item_type', $item_type);

		// find common friends of two persons: 1) whose posted ad, 2) current user
		$final_all_ads = array();
		 if ($this->activeUser != null) {
			// pr($value);die();
			foreach ($items['rows'] as $value) {
				$ad_makers_fb_id = $value['doc']['personal_info']['fb_id'];
				$current_user_fb_id = $this->activeUser['User']['fb_id'];


				$current_user_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $current_user_fb_id),
						'fields' => array('fb_id')
					));
				$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $ad_makers_fb_id),
						'fields' => array('fb_id')
					));
				// pr($current_user_friends_fb_id);die();
				$common_frnds_fb_id = array();
				// loop both to get same fb_id
				foreach ($current_user_friends_fb_id as $currents_common) {
					foreach ($ad_maker_friends_fb_id as $makers_common) {
						if ($currents_common === $makers_common) {
							array_push($common_frnds_fb_id, $currents_common);
						}
					}
				}
				// pr($common_frnds_fb_id);
				// find details of got fb_id from user table
				$last_common_friend_list = array();
				foreach ($common_frnds_fb_id as $common_friend) {
					$common_friend_details = $this->User->find('first', array(
							'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
							'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
						));
					if ($common_friend_details != null) {
						$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
						$tmp_common_friend['email'] = $common_friend_details['User']['username'];
						$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
						$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
						if ($common_friend['FbFriend']['fb_id'] != $this->activeUser['User']['fb_id']) {
							array_push($last_common_friend_list, $tmp_common_friend);
						}
					}
				}
				$this->set('mutual_friend_details', $last_common_friend_list);
				// pr($last_common_friend_list);die();
				$value['doc']['FbFriend'] = $last_common_friend_list;
				// pr($value); die();
				array_push($final_all_ads, $value);

			}
			$this->set('items', $final_all_ads);
		} else {
			$this->set('items', $items['rows']);
		}

		//Single Item
		//$conditions = array('Item.id' => 'item_5572cf97-ab50-48b6-90ef-11fd52d40771');
		//$result = $this->Item->find('first', compact('conditions'));
		//print_r($result);die();
	}

	// Ajax for infinite scroll for Item Type
	public function index_ajax($id = null, $page=null) {

		$this->layout = 'ajax';

		if($page==null){
            $page = 1;
        }
        $limit = 5;
		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/by_item_type?include_docs=true&keys=[%22'.$id.'%22]&limit='.$limit.'&skip='.$page*$limit);

		$this->set('items' ,$items['rows']);
	}

	// displays items by item sub categories
	public function sub_category_items($id = null) {

        // set page for infinite scroll
	 	$this->set('page',1);

        $limit=5;

        if ($this->location != null) {

        	$find_result = 'by_city:"'.$this->location.'"%20AND%20'. 'item_category_id:"'.$id.'"';
        }
        else {
        	$find_result = 'item_category_id:"'.$id.'"';
        }

		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true&limit='.$limit);
		// $this->set('items' ,$items['rows']);
		$this->set('id' , $id);

		// find common friends of two persons: 1) whose posted ad, 2) current user
		$final_all_ads = array();
		 if ($this->activeUser != null) {
			// pr($value);die();
			foreach ($items['rows'] as $value) {
				$ad_makers_fb_id = $value['doc']['personal_info']['fb_id'];
				$current_user_fb_id = $this->activeUser['User']['fb_id'];


				$current_user_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $current_user_fb_id),
						'fields' => array('fb_id')
					));
				$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $ad_makers_fb_id),
						'fields' => array('fb_id')
					));
				// pr($current_user_friends_fb_id);die();
				$common_frnds_fb_id = array();
				// loop both to get same fb_id
				foreach ($current_user_friends_fb_id as $currents_common) {
					foreach ($ad_maker_friends_fb_id as $makers_common) {
						if ($currents_common === $makers_common) {
							array_push($common_frnds_fb_id, $currents_common);
						}
					}
				}
				// pr($common_frnds_fb_id);
				// find details of got fb_id from user table
				$last_common_friend_list = array();
				foreach ($common_frnds_fb_id as $common_friend) {
					$common_friend_details = $this->User->find('first', array(
							'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
							'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
						));
					if ($common_friend_details != null) {
						$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
						$tmp_common_friend['email'] = $common_friend_details['User']['username'];
						$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
						$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
						if ($common_friend['FbFriend']['fb_id'] != $this->activeUser['User']['fb_id']) {
							array_push($last_common_friend_list, $tmp_common_friend);
						}
					}
				}
				$this->set('mutual_friend_details', $last_common_friend_list);
				// pr($last_common_friend_list);die();
				$value['doc']['FbFriend'] = $last_common_friend_list;
				// pr($value); die();
				array_push($final_all_ads, $value);

			}
			$this->set('items', $final_all_ads);
		} else {
			$this->set('items', $items['rows']);
		}

		// set breadcrumb
		$item_details = $this->ItemCategory->find('first', array('conditions' => array('ItemCategory.id' => $id), 'fields' => array('ItemCategory.id', 'ItemCategory.name', 'item_type_id')));
		$item_type_name = $this->ItemType->find('first', array('conditions'=> array('id' => $item_details['ItemCategory']['item_type_id']), 'fields'=> array('id', 'name')));
		$item_details['ItemCategory']['item_type_name'] = $item_type_name['ItemType']['name'];

		$this->set('item_details', $item_details);
	}

	// Ajax for infinite scroll for sub Item categories
	public function sub_category_items_ajax($id = null, $page=null) {

		$this->layout = 'ajax';

		if($page==null){
            $page = 1;
        }
        $limit = 2;
		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/by_category?include_docs=true&keys=[%22'.$id.'%22]&limit='.$limit.'&skip='.$page*$limit);

		$this->set('items' ,$items['rows']);
	}

	// this function displays the single product details
	public function product_detail($id = null) {

		$item_detail = $this->AdPost->curlGet('axi_fxchng/'.$id);
		$this->set('item_detail' ,$item_detail);
		// pr($item_detail);
		// pr($this->activeUser);
		$sub_item_category_id = $item_detail['item_category']['id'];

		 if ($this->location != null) {

        	$find_result = 'by_city:"'.$this->location.'"%20AND%20'. 'item_category_id:"'.$sub_item_category_id.'"';
        }
        else {
        	$find_result = 'item_category_id:"'.$sub_item_category_id.'"';
        }

        $limit = 15;

		// set similar items
		$this->set('page',$page=0);
		// $items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/by_category?include_docs=true&keys=[%22'.$sub_item_category_id.'%22]&limit='.$limit);
		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true&limit='.$limit);
		// $this->set('items' ,$items['rows']);

		// set breadcrumb
		$item_details = $this->ItemCategory->find('first', array('conditions' => array('ItemCategory.id' => $sub_item_category_id), 'fields' => array('ItemCategory.id', 'ItemCategory.name', 'item_type_id')));
		$item_type_name = $this->ItemType->find('first', array('conditions'=> array('id' => $item_details['ItemCategory']['item_type_id']), 'fields'=> array('id', 'name')));
		$item_details['ItemCategory']['item_type_name'] = $item_type_name['ItemType']['name'];

		$this->set('item_details', $item_details);

		// find common friends of two persons: 1) whose posted ad, 2) current user
		if ($this->activeUser != null) {
			$ad_makers_fb_id = $item_detail['personal_info']['fb_id'];
			$current_user_fb_id = $this->activeUser['User']['fb_id'];


			$current_user_friends_fb_id = $this->FbFriend->find('all', array(
					'conditions' => array('user_fb_id' => $current_user_fb_id),
					'fields' => array('fb_id')
				));
			$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
					'conditions' => array('user_fb_id' => $ad_makers_fb_id),
					'fields' => array('fb_id')
				));
			$common_frnds_fb_id = array();
			// loop both to get same fb_id
			foreach ($current_user_friends_fb_id as $currents_common) {
				foreach ($ad_maker_friends_fb_id as $makers_common) {
					if ($currents_common === $makers_common) {
						array_push($common_frnds_fb_id, $currents_common);
					}
				}
			}
			// pr($common_frnds_fb_id);
			// find details of got fb_id from user table
			$last_common_friend_list = array();
			foreach ($common_frnds_fb_id as $common_friend) {
				$common_friend_details = $this->User->find('first', array(
						'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
						'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
					));
				if ($common_friend_details != null) {
					$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
					$tmp_common_friend['email'] = $common_friend_details['User']['username'];
					$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
					$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
					array_push($last_common_friend_list, $tmp_common_friend);
				}
			}
			$this->set('mutual_friend_details', $last_common_friend_list);
		}

		// find common friends of two persons: 1) whose posted ad, 2) current user
		$final_all_ads = array();
		 if ($this->activeUser != null) {
			// pr($value);die();
			foreach ($items['rows'] as $value) {
				$ad_makers_fb_id = $value['doc']['personal_info']['fb_id'];
				$current_user_fb_id = $this->activeUser['User']['fb_id'];


				$current_user_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $current_user_fb_id),
						'fields' => array('fb_id')
					));
				$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $ad_makers_fb_id),
						'fields' => array('fb_id')
					));
				// pr($current_user_friends_fb_id);die();
				$common_frnds_fb_id = array();
				// loop both to get same fb_id
				foreach ($current_user_friends_fb_id as $currents_common) {
					foreach ($ad_maker_friends_fb_id as $makers_common) {
						if ($currents_common === $makers_common) {
							array_push($common_frnds_fb_id, $currents_common);
						}
					}
				}
				// pr($common_frnds_fb_id);
				// find details of got fb_id from user table
				$last_common_friend_list = array();
				foreach ($common_frnds_fb_id as $common_friend) {
					$common_friend_details = $this->User->find('first', array(
							'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
							'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
						));
					if ($common_friend_details != null) {
						$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
						$tmp_common_friend['email'] = $common_friend_details['User']['username'];
						$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
						$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
						if ($common_friend['FbFriend']['fb_id'] != $this->activeUser['User']['fb_id']) {
							array_push($last_common_friend_list, $tmp_common_friend);
						}
					}
				}
				$this->set('mutual_friend_details', $last_common_friend_list);
				// pr($last_common_friend_list);die();
				$value['doc']['FbFriend'] = $last_common_friend_list;
				// pr($value); die();
				array_push($final_all_ads, $value);

			}
			$this->set('items', $final_all_ads);
		} else {
			$this->set('items', $items['rows']);
		}
	}

	public function get_type_filter_data($id=null, $used=null, $new=null, $from_date=null, $to_date=null, $individual=null, $dealer=null, $from_price=null, $to_price=null, $main_search = null) {

		if ($this->request->is('post')) {

			// set default
			$find_result = 'item_type_id:"'.$id.'"';

			// for condition = used Or new
			if ($used != 'null' && $new != 'null') {
				$find_result .= '%20AND%20'.'condition:"'.$used.'"%20OR%20'.'condition:"'.$new.'"';
			}
			elseif ($new != 'null' && $used == 'null') {
				$find_result .= '%20AND%20'.'condition:"'.$new.'"';
			}
			elseif ($used != 'null' && $new == 'null') {
				$find_result .= '%20AND%20'.'condition:"'.$used.'"';
			}

			// for last days
			if($from_date != 'null' && $to_date != 'null') {
				$find_result .= '%20AND%20'.'created_filter:['.$from_date.'%20TO%20'.$to_date.']';
			}

			// for ad_by = individual Or dealer
			if ($individual != 'null' && $dealer != 'null') {
				$find_result .= '%20AND%20'.'ad_by:"'.$individual.'"%20OR%20'.'ad_by:"'.$dealer.'"';
			}
			elseif ($dealer != 'null' && $individual == 'null') {
				$find_result .= '%20AND%20'.'ad_by:"'.$dealer.'"';

			}
			elseif ($individual != 'null' && $dealer == 'null') {
				$find_result .= '%20AND%20'.'ad_by:"'.$individual.'"';
			}

			// for price
			if($from_price != 'null' && $to_price != 'null') {
				$find_result .= '%20AND%20'.'price:['.$from_price.'%20TO%20'.$to_price.']';
			}

			// for main_search
			if ($main_search != 'null') {
				$find_result .= '%20AND%20'.'main_search:'.$main_search.'*';
			}

			$this->layout = 'ajax_layout';
			$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
			// $this->set('items' ,$items['rows']);
			// find common friends of two persons: 1) whose posted ad, 2) current user
			$final_all_ads = array();
		 	if ($this->activeUser != null) {
				// pr($value);die();
				foreach ($items['rows'] as $value) {
					$ad_makers_fb_id = $value['doc']['personal_info']['fb_id'];
					$current_user_fb_id = $this->activeUser['User']['fb_id'];


					$current_user_friends_fb_id = $this->FbFriend->find('all', array(
							'conditions' => array('user_fb_id' => $current_user_fb_id),
							'fields' => array('fb_id')
						));
					$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
							'conditions' => array('user_fb_id' => $ad_makers_fb_id),
							'fields' => array('fb_id')
						));
					// pr($current_user_friends_fb_id);die();
					$common_frnds_fb_id = array();
					// loop both to get same fb_id
					foreach ($current_user_friends_fb_id as $currents_common) {
						foreach ($ad_maker_friends_fb_id as $makers_common) {
							if ($currents_common === $makers_common) {
								array_push($common_frnds_fb_id, $currents_common);
							}
						}
					}
					// pr($common_frnds_fb_id);
					// find details of got fb_id from user table
					$last_common_friend_list = array();
					foreach ($common_frnds_fb_id as $common_friend) {
						$common_friend_details = $this->User->find('first', array(
								'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
								'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
							));
						if ($common_friend_details != null) {
							$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
							$tmp_common_friend['email'] = $common_friend_details['User']['username'];
							$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
							$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
							if ($common_friend['FbFriend']['fb_id'] != $this->activeUser['User']['fb_id']) {
								array_push($last_common_friend_list, $tmp_common_friend);
							}
						}
					}
					$this->set('mutual_friend_details', $last_common_friend_list);
					// pr($last_common_friend_list);die();
					$value['doc']['FbFriend'] = $last_common_friend_list;
					// pr($value); die();
					array_push($final_all_ads, $value);

				}
				$this->set('items', $final_all_ads);
			} else {
				$this->set('items', $items['rows']);
			}

		}
	}

	public function get_category_filter_data($id=null, $used=null, $new=null, $from_date=null, $to_date=null, $individual=null, $dealer=null, $from_price=null, $to_price=null, $main_search = null) {

		if ($this->request->is('post')) {

			// set default
			$find_result = 'item_category_id:"'.$id.'"';

			// for condition = used Or new
			if ($used != 'null' && $new != 'null') {
				$find_result .= '%20AND%20'.'condition:"'.$used.'"%20OR%20'.'condition:"'.$new.'"';
			}
			elseif ($new != 'null' && $used == 'null') {
				$find_result .= '%20AND%20'.'condition:"'.$new.'"';
			}
			elseif ($used != 'null' && $new == 'null') {
				$find_result .= '%20AND%20'.'condition:"'.$used.'"';
			}

			// for last days
			if($from_date != 'null' && $to_date != 'null') {
				$find_result .= '%20AND%20'.'created_filter:['.$from_date.'%20TO%20'.$to_date.']';
			}

			// for ad_by = individual Or dealer
			if ($individual != 'null' && $dealer != 'null') {
				$find_result .= '%20AND%20'.'ad_by:"'.$individual.'"%20OR%20'.'ad_by:"'.$dealer.'"';
			}
			elseif ($dealer != 'null' && $individual == 'null') {
				$find_result .= '%20AND%20'.'ad_by:"'.$dealer.'"';

			}
			elseif ($individual != 'null' && $dealer == 'null') {
				$find_result .= '%20AND%20'.'ad_by:"'.$individual.'"';
			}

			// for price
			if($from_price != 'null' && $to_price != 'null') {
				$find_result .= '%20AND%20'.'price:['.$from_price.'%20TO%20'.$to_price.']';
			}

			// for main_search
			if ($main_search != 'null') {
				$find_result .= '%20AND%20'.'main_search:'.$main_search.'*';
			}
			$this->layout = 'ajax_layout';
			// $items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/msg_by_fb_id?key="500374490112293"&include_docs=true');
			$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
			// $this->set('items' ,$items['rows']);

			// find common friends of two persons: 1) whose posted ad, 2) current user
			$final_all_ads = array();
		 	if ($this->activeUser != null) {
				// pr($value);die();
				foreach ($items['rows'] as $value) {
					$ad_makers_fb_id = $value['doc']['personal_info']['fb_id'];
					$current_user_fb_id = $this->activeUser['User']['fb_id'];


					$current_user_friends_fb_id = $this->FbFriend->find('all', array(
							'conditions' => array('user_fb_id' => $current_user_fb_id),
							'fields' => array('fb_id')
						));
					$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
							'conditions' => array('user_fb_id' => $ad_makers_fb_id),
							'fields' => array('fb_id')
						));
					// pr($current_user_friends_fb_id);die();
					$common_frnds_fb_id = array();
					// loop both to get same fb_id
					foreach ($current_user_friends_fb_id as $currents_common) {
						foreach ($ad_maker_friends_fb_id as $makers_common) {
							if ($currents_common === $makers_common) {
								array_push($common_frnds_fb_id, $currents_common);
							}
						}
					}
					// pr($common_frnds_fb_id);
					// find details of got fb_id from user table
					$last_common_friend_list = array();
					foreach ($common_frnds_fb_id as $common_friend) {
						$common_friend_details = $this->User->find('first', array(
								'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
								'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
							));
						if ($common_friend_details != null) {
							$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
							$tmp_common_friend['email'] = $common_friend_details['User']['username'];
							$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
							$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
							if ($common_friend['FbFriend']['fb_id'] != $this->activeUser['User']['fb_id']) {
								array_push($last_common_friend_list, $tmp_common_friend);
							}
						}
					}
					$this->set('mutual_friend_details', $last_common_friend_list);
					// pr($last_common_friend_list);die();
					$value['doc']['FbFriend'] = $last_common_friend_list;
					// pr($value); die();
					array_push($final_all_ads, $value);

				}
				$this->set('items', $final_all_ads);
			} else {
				$this->set('items', $items['rows']);
			}
		}
	}

	public function set_ad_reply() {

		if ($this->request->is('post')) {

			$this->layout = 'ajax_layout';
			$sender_data = $this->request->data;

			// get uuid
			$guid = String::uuid();
			// get todays datetime in seconds
			$time_in_seconds =  CakeTime::convert(time(), new DateTimeZone('Asia/Calcutta'));
			// set array for cloudant DB
			$msg_array['id'] = "msg_".$time_in_seconds.'_'.$guid;
			$msg_array['created_timestamp'] = $time_in_seconds;
			$msg_array['doc_type'] = 'msg';
			$msg_array['ad_id'] = $sender_data['ad_id'];
			$msg_array['ad_fb_id'] = $sender_data['ad_fb_id'];
			$msg_array['ad_title'] = $sender_data['ad_title'];
			$msg_array['sender_fb_id'] = $this->activeUser['User']['fb_id'];
			$msg_array['name'] =	$sender_data['senderName'];
			$msg_array['mobile'] =	$sender_data['senderMobile'];
			$msg_array['email'] =	$sender_data['senderEmail'];
			$msg_array['message'] =	$sender_data['senderMsg'];
			if (isset($msg_array['dir'])) {
				$msg_array['primary_photo']['dir'] = $sender_data['dir'];
				$msg_array['primary_photo']['file_name'] = $sender_data['file_name'];
			}
			// Set created timestamp
            date_default_timezone_set('Asia/Calcutta');
            $todays = new DateTime();
			$msg_array['created'] =	$todays->format('Y-m-d H:i:s');
			pr($msg_array);die();
			$this->SetAdReply->setDataSource('cloudant_db');
			if($this->SetAdReply->save($msg_array)) {
				$Email = new CakeEmail('default');
				// set variable values
				$Email->viewVars(array(
					'name' => $sender_data['ad_person_name'],
					'sender_name' => $sender_data['senderName'],
					'sender_mobile' => $sender_data['senderMobile'],
					'sender_email' => $msg_array['email'],
					'sender_msg' => $sender_data['senderMsg'],
					'ad_title' => $sender_data['ad_title'],
					'description' => $sender_data['ad_desc']
					));
				// set format html/text or both
				$Email->emailFormat('html');
				$Email->subject('Fxchng support');
				$Email->template('msg_reply', 'fxchng'); // welcome template and fxchng layout
       			$Email->to($sender_data['ad_email']);
				$Email->send();
				echo "1";
			} else {
				$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
        		$this->redirect($this->referer());
        		echo "0";
			}
		}
	}

	public function make_an_offer() {

		if($this->request->is('post')) {

			$this->layout="ajax_layout";

			$sms_data = $this->request->data;

			$ad_title = $sms_data['ad_title'];
			$offer_rs = $sms_data['offer_rs'];
			$receiver_mobile = $sms_data['receiver_mobile'];
			$sender_mobile = $sms_data['sender_mobile'];
			$sender_name = $this->activeUser['User']['fb_name'];
			$sender_email = $this->activeUser['User']['username'];

			// save on cloudant
	 		// get uuid
			$guid = String::uuid();
			// get todays datetime in seconds
			$time_in_seconds =  CakeTime::convert(time(), new DateTimeZone('Asia/Calcutta'));
			// set array for cloudant DB
			$msg_array['id'] = "msg_".$time_in_seconds.'_'.$guid;
			$msg_array['created_timestamp'] = $time_in_seconds;
			$msg_array['doc_type'] = 'sms';
			$msg_array['ad_id'] = $sms_data['ad_id'];
			$msg_array['ad_fb_id'] = $sms_data['ad_fb_id'];
			$msg_array['sender_fb_id'] = $this->activeUser['User']['fb_id'];
			$msg_array['name'] =	$sender_name;
			$msg_array['mobile'] =	$sender_mobile;
			$msg_array['email'] =	$sender_email;
			// Set created timestamp
            date_default_timezone_set('Asia/Calcutta');
            $todays = new DateTime();
			$msg_array['created'] =	$todays->format('Y-m-d H:i:s');
			// pr($msg_array);die();
			$this->SetAdReply->setDataSource('cloudant_db');
			if(!$this->SetAdReply->save($msg_array)) {
				echo 0;
			}
			//send sms

			if ($receiver_mobile != null) {

				$sms = new Sms();
		 		$sms->sendMakeAnOffer($ad_title, $sender_name, $sender_mobile, $sender_email, $offer_rs, $receiver_mobile);
				//$msg_array['message'] =	$sender_data['senderMsg'];
		 		echo "1";
			} else {
				echo "0";
			}
		}
	}

	public function get_help() {

		if ($this->request->is('post')) {

			$this->layout = 'ajax_layout';
			$sender_data = $this->request->data;

			if ($sender_data != null) {

				$Email = new CakeEmail('default');
				// set variable values
				$Email->viewVars(array(
					'name' => $sender_data['receiver_name'],
					'sender_name' => $this->activeUser['User']['fb_name'],
					// 'sender_mobile' => $sender_data['senderMobile'],
					'sender_email' => $this->activeUser['User']['username'],
					'sender_msg' => $sender_data['message'],
					'ad_title' => $sender_data['ad_title'],
					'description' => $sender_data['ad_desc'],
					'ad_perosn_name' => $sender_data['ad_person_name'],
					'ad_perosn_email' => $sender_data['ad_email']
					));
				// set format html/text or both
				$Email->emailFormat('html');
				$Email->subject('Help your friend '.$this->activeUser['User']['fb_name']);
				$Email->template('help', 'fxchng'); // welcome template and fxchng layout
	   			$Email->to($sender_data['receiver_email']);
				$Email->send();
				echo "1";
			} else {
				echo "0";
			}
		}
	}

	public function set_common_friends ($ad_fb_id = null) {
		$this->layout = 'ajax_layout';
		// pr($ad_fb_id);die();
		// $this->redirect($this->referer
		// find common friends of two persons: 1) whose posted ad, 2) current user

		if ($this->activeUser != null) {
			$ad_makers_fb_id = $ad_fb_id;
			$current_user_fb_id = $this->activeUser['User']['fb_id'];
			$current_user_friends_fb_id = $this->FbFriend->find('all', array(
					'conditions' => array('user_fb_id' => $current_user_fb_id),
					'fields' => array('fb_id')
				));
			$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
					'conditions' => array('user_fb_id' => $ad_makers_fb_id),
					'fields' => array('fb_id')
				));
			$common_frnds_fb_id = array();
			// loop both to get same fb_id
			foreach ($current_user_friends_fb_id as $currents_common) {
				foreach ($ad_maker_friends_fb_id as $makers_common) {
					if ($currents_common === $makers_common) {
						array_push($common_frnds_fb_id, $currents_common);
					}
				}
			}
			// pr($common_frnds_fb_id);
			// find details of got fb_id from user table
			$last_common_friend_list = array();
			foreach ($common_frnds_fb_id as $common_friend) {
				$common_friend_details = $this->User->find('first', array(
						'conditions' => array('fb_id' => $common_friend['FbFriend']['fb_id']),
						'fields' => array('fb_name', 'username', 'fb_profilepic', 'fb_phone')
					));
				if ($common_friend_details != null) {
					$tmp_common_friend['mutual_friend_name'] = $common_friend_details['User']['fb_name'];
					$tmp_common_friend['email'] = $common_friend_details['User']['username'];
					$tmp_common_friend['mutual_friend_pic'] = $common_friend_details['User']['fb_profilepic'];
					$tmp_common_friend['mobile'] = $common_friend_details['User']['fb_phone'];
					array_push($last_common_friend_list, $tmp_common_friend);
				}
			}
			$this->set('mutual_friend_details', $last_common_friend_list);
		}
	}
}
?>