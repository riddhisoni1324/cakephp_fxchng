<?php
class HomeController extends AppController {

	public $helpers = array('Html', 'Js', 'Form');
	public $uses = array('AdPost', 'Category', 'User', 'Home', 'FbFriend', 'ItemCategory');

	public function beforeFilter() {

		// call beforeFilter from AppController
		AppController::beforeFilter();
		// allow actions
		$this->Auth->allow('get_category_filter_data', 'get_ads_by_search', 'redirect_to_home', 'index', 'index_ajax', 'get_location', 'get_ads_by_city', 'get_friends_ads', 'get_recent_ads');
		// set datasource
		$this->AdPost->setDataSource('cloudant_db');
		// Set the overall layout
		$this->layout = 'main';
		// set title
		$title = "Home";
     	$this->set('title_for_layout',$title);
	}

	public function index() {

        $this->set('page',0);
        $limit=15;
        // pr($this->location);
        if ($this->location != null) {

        	$find_result = 'by_city:"'.$this->location.'"';
        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
        }
        else {

        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q=*:*&sort="-sort_time"&include_docs=true&limit='.$limit);
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
                // pr($current_user_friends_fb_id);die();
				$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $ad_makers_fb_id),
						'fields' => array('fb_id')
					));


				// pr($current_user_friends_fb_id);die();
				$common_frnds_fb_id = array();
				// loop both to get same fb_id
				foreach ($current_user_friends_fb_id as $currents_common) {
                    // pr($currents_common);die();
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
                    // pr($common_friend);die();
                    if (in_array($common_friend, $ad_maker_friends_fb_id)) {

                    } else {

                    }
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
		// pr($final_all_ads);die();

		// set mutual friend details
		$this->_set_mutual_frnd_box();
	}

	public function index_ajax($page=null) {

		// set datasource
		$this->AdPost->setDataSource('cloudant_db');

		$this->layout = 'ajax';

		if($page==null){
            $page = 1;
        }
        $limit = 5;
		// View (by category)

		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q=*:*&sort="-sort_time"&include_docs=true&limit='.$limit.'&skip='.$page*$limit);
		$this->set('items' ,$items['rows']);
	}

	public function set_mutual_friend_box() {

		$this->layout = 'ajax_layout';
		$this->AdPost->setDataSource('cloudant_db');
		$this->_set_mutual_frnd_box();
	}

	// this function set the mutual friends box
	public function _set_mutual_frnd_box() {
		// set mutual friend details
		if ($this->activeUser != null) {
			$user_friends_details = $this->FbFriend->find('all', array('conditions' => array('user_fb_id' => $this->activeUser['User']['fb_id'])));
			// pr($user_friends_details);
			$user_fb_id = array();
	       	foreach ($user_friends_details as $key => $value) {
	   			array_push($user_fb_id, $value['FbFriend']['fb_id']);
	       	}
	       	// pr($user_fb_id);
	       	$mutual_friend_details = array();
	       	foreach ($user_fb_id as $fb_id) {
	       		$tmp_detials = $this->User->find('first', array('fields' => array('fb_name', 'fb_profilepic', 'fb_id'), 'conditions' => array('fb_id' => $fb_id)));

	       		// get last ad of friend
	       		$find_result = 'by_fb_id:"'.$fb_id.'"';
				$post = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true&limit=1');
				// pr($post);
				if ($post['total_rows'] == 1) {
					$this->set('post' ,$post['rows']);
					// pr($post);
					$ad_detail = '1 ad posted till';
					$ad_id = $post['rows'][0]['doc']['_id'];
				} else if ($post['total_rows'] > 1) {
					$ad_detail  = $post['total_rows']. ' ads posted till.';
					$ad_id = $post['rows'][0]['doc']['_id'];
				} else {
					$ad_detail = 'No ad posted till';
					$ad_id = '0';
				}
				if ($tmp_detials != null) {
					$tmp_mutual_friend_details['mutual_friend_fb_id'] = $tmp_detials['User']['fb_id'];
		       		$tmp_mutual_friend_details['mutual_friend_name'] = $tmp_detials['User']['fb_name'];
		       		$tmp_mutual_friend_details['mutual_friend_pic'] = $tmp_detials['User']['fb_profilepic'];
		       		$tmp_mutual_friend_details['ad_detial'] = $ad_detail;
		       		$tmp_mutual_friend_details['mutual_friend_ad_details'] = $ad_id;
		       		array_push($mutual_friend_details, $tmp_mutual_friend_details);
				}
	       	}

	       	$this->set('mutual_friend_details', $mutual_friend_details);
		}
	}

	// set location on session
	public function get_location($location = null) {

		$this->Session->write('location', $location);
	}

	public function get_friends_ads() {

		// set ajax layout
		$this->layout = 'ajax_layout';

		$all_friends_ads = array();
		$all_friends_fb_id = array();

		if ($this->activeUser != null) {

			// find his/her friends fb_id
			$friends_fb_id = $this->FbFriend->find('all', array('conditions' => array('user_fb_id' => $this->activeUser['User']['fb_id'])));

			foreach ($friends_fb_id as $tmp_fb_id) {
				// find his/her friends friend fb_id
		        $friends_friend_fb_id = $this->FbFriend->find('all', array('conditions' => array('user_fb_id' => $tmp_fb_id['FbFriend']['fb_id'])));

		        foreach ($friends_friend_fb_id as $value) {
		        	if ($value['FbFriend']['fb_id'] != $this->activeUser['User']['fb_id']) {
		        		array_push($all_friends_fb_id, $value['FbFriend']['fb_id']);
		        	}
		        }
			}
			// search all_friend ads
			foreach ($all_friends_fb_id as $tmp_all_friends_fb_id) {

				// pr($this->location);
		        if ($this->location != null) {

		        	$find_result = 'by_city:"'.$this->location.'"'.'%20AND%20'. 'by_fb_id:'. '"'.$tmp_all_friends_fb_id.'"';
		        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
		        }
		        else {
		        	$find_result = 'by_fb_id:"'.$tmp_all_friends_fb_id.'"';
		        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
		        	// pr($items['rows']);
		        	foreach ($items['rows'] as $value) {
		        		array_push($all_friends_ads, $value);
		        	}
		        }
			}
			// array of all friend and his friends ads
			// $this->set('items' ,$all_friends_ads);

			// find common friends of two persons: 1) whose posted ad, 2) current user
			$final_all_ads = array();
		 	if ($this->activeUser != null) {
				// pr($value);die();
				foreach ($all_friends_ads as $value) {
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

	public function get_recent_ads() {
		$this->layout = "ajax_layout";

	 	$this->set('page',0);
        $limit=15;
        // pr($this->location);
        if ($this->location != null) {

        	$find_result = 'by_city:"'.$this->location.'"';
        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
        }
        else {
        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q=*:*&sort="-sort_time"&include_docs=true&limit='.$limit);
        }
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

	// for set search paramaeter in url
	public function redirect_to_home() {

		if ($this->request->is('post')) {

			$word = $this->request->data;
			return $this->redirect(array('action' => 'get_ads_by_search', $word['keyword']));
		}
	}

	public function get_ads_by_search($main_search = null, $cat_id = null) {

		$this->set('search', $main_search);

	 	if ($this->location != null) {

        	$find_result = 'by_city:"'.$this->location.'"'. '%20AND%20'.'main_search:'.$main_search.'*';
        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
        }
        else {
        	$find_result = 'main_search:'.$main_search.'*';
        	$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true');
        }
        // $this->set('items' ,$items['rows']);

        // pr($items);die();

   		$temp_item_arr = array();
   		$tmp_item_category = array();
   		foreach ($items['rows'] as $value) {

   			array_push($temp_item_arr, $value['doc']['item_type']['name']);
   			array_push($tmp_item_category, $value['doc']['item_category']['name']);
   		}

   		$unique_item_type = array_unique($temp_item_arr);
   		$unique_item_category = array_unique($tmp_item_category);

   		$final_count_type = array();
   		foreach ($unique_item_type as $value_1) {
   			// pr($value_1);
   			$type = 0;
   			foreach ($items['rows'] as $value_2) {
   				// pr($value_2['doc']['item_type']['name']);
   				if ($value_1 == $value_2['doc']['item_type']['name']) {
   					$tmp_typ['id'] = $value_2['doc']['item_type']['id'];
					$tmp_typ['name'] = $value_2['doc']['item_type']['name'];
   					$type++;
   				} else {
   					$type;
   				}
				$tmp_typ['total'] = $type;
   			}
   			array_push($final_count_type, $tmp_typ);
   		}

   		$final_count_category = array();
        $tmp_multi_cat = array();
   		foreach ($unique_item_category as $value_1) {
   			// pr($value_1);
   			$category = 0;
   			foreach ($items['rows'] as $value_2) {

   				if ($value_1 == $value_2['doc']['item_category']['name']) {

                    //  if (in_array($value_2['doc']['item_type']['name'], $tmp_multi_cat)) {
                    //     pr($value_2['doc']['item_type']['name']);
                    //     array_push(array, var)
                    // } else {

                    //     array_push($tmp_multi_cat, $value_2['doc']['item_type']['name']);
                    // }

   					$tmp_cat['item_type']['id'] = $value_2['doc']['item_type']['id'];
					$tmp_cat['item_type']['name'] = $value_2['doc']['item_type']['name'];
					$tmp_cat['item_type']['category']['id'] = $value_2['doc']['item_category']['id'];
					$tmp_cat['item_type']['category']['name'] = $value_2['doc']['item_category']['name'];
   					$category++;
   				} else {
   					$category;
   				}
				$tmp_cat['item_type']['category']['total'] = $category;
   			}
   			array_push($final_count_category, $tmp_cat);
   		}
   		// pr($final_count_category);

   		$fiburcation = array();
        $tmp_itm_type = array();
        $tmp_multi_cat = array();
   		foreach ($final_count_type as $key => $value) {

   			foreach ($final_count_category as $key_1 => $value_1) {

   				if ($value['id'] == $value_1['item_type']['id']) {

                    // push item_type in one aaray();
                    // if (in_array($value['name'], $tmp_itm_type)) {
                    //     pr($value['name']);
                    //     $tmp_fiburcation['cat']['id'] = $value_1['item_type']['category']['id'];
                    //     $tmp_fiburcation['cat']['name'] = $value_1['item_type']['category']['name'];
                    //     $tmp_fiburcation['cat']['total'] = $value_1['item_type']['category']['total'];
                    //     // array_push($tmp_fiburcation, $tmp_fiburcation['cat']);
                    // } else {

                    //     $tmp_fiburcation['id'] = $value['id'];
                    //     $tmp_fiburcation['name'] = $value['name'];
                    //     $tmp_fiburcation['total'] = $value['total'];

                    //     array_push($tmp_itm_type, $value['name']);

                    //     $tmp_fiburcation['cat']['id'] = $value_1['item_type']['category']['id'];
                    //     $tmp_fiburcation['cat']['name'] = $value_1['item_type']['category']['name'];
                    //     $tmp_fiburcation['cat']['total'] = $value_1['item_type']['category']['total'];
                    //     // array_push($tmp_fiburcation, $tmp_fiburcation['cat']);

                    // }
                        $tmp_fiburcation['id'] = $value['id'];
                        $tmp_fiburcation['name'] = $value['name'];
                        $tmp_fiburcation['total'] = $value['total'];
                        $tmp_fiburcation['cat']['id'] = $value_1['item_type']['category']['id'];
                        $tmp_fiburcation['cat']['name'] = $value_1['item_type']['category']['name'];
                        $tmp_fiburcation['cat']['total'] = $value_1['item_type']['category']['total'];
                        array_push($fiburcation, $tmp_fiburcation);
   				}
   			}
   		}
   		// pr($fiburcation);die();
   		$this->set('fiburcation', $fiburcation);

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

	public function get_category_filter_data($id=null, $used=null, $new=null, $from_date=null, $to_date=null, $individual=null, $dealer=null, $from_price=null, $to_price=null, $main_search = null) {

		if ($this->request->is('post')) {

			// set default
			$find_result = 'main_search:'.$main_search.'*';

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
			if ($id != 'null') {
				$find_result .= '%20AND%20'.'item_category_id:"'.$id.'"';
			}

			// pr($find_result);die();
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
}
?>