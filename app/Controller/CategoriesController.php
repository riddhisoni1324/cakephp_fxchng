<?php
include_once('../Plugin/sms_engine/sms.php');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class CategoriesController extends AppController {
    public $components = array('RequestHandler');
	public $uses = array('Category','ItemCategory', 'Brand', 'Role', 'AutoModel', 'AdPost', 'ItemPhoto', 'ItemType', 'SetAdReply','FbFriend');
	public $helpers = array('Html', 'Js', 'Form');

	public function beforeFilter() {

	AppController::beforeFilter();

		$this->Auth->allow('mutual_friend','common_friend','get_brands','get_roles','make_an_offer','index', "index_ajax", "product_detail", 'sub_category_items', 'sub_category_items_ajax', 'get_type_filter_data', 'get_category_filter_data', 'set_ad_reply', 'get_help', 'set_common_friends');

		$this->layout = 'main';

		$this->AdPost->setDataSource('cloudant_db');

	}

	public function index($id = null) {

		$item = $this->ItemType->find('all');
	        $this->set(array(
	            'ItemType' => $item,
	            '_serialize' => array('ItemType')
	        ));
	    }


    // displays items by item sub categories
    public function sub_category_items($id = null,$location = null) {
		       
		$this->set('page',1);

		       $limit=100;

		       if ($location != null) {

		       	$find_result = 'by_city:"'.$location.'"%20AND%20'. 'item_category_id:"'.$id.'"';
		       }
		       else {
		       	$find_result = 'item_category_id:"'.$id.'"';
		       }

		    $sub_cat = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true&limit='.$limit);
		
		    $this->set(array(
	            'AdPost' => $sub_cat,
	            '_serialize' => array('AdPost')
	        ));
	    }
	    public function product_detail($id = null) {

			$ad_detail = $this->AdPost->curlGet('axi_fxchng/'.$id);
			
	        $this->set(array(
	            'AdPost' => $ad_detail,
	            '_serialize' => array('AdPost')
	        ));

		} 

	   public function get_brands($cat_id = null ) {

			$this->AdPost->setDataSource('cloudant_db');
			$brands = $this->AdPost->curlGet('axi_fxchng/_all_docs?key="brand_'.$cat_id.'"&include_docs=true');

			$this->set(array(
	            'AdPost' => $brands,
	            '_serialize' => array('AdPost')
	        ));
			
		 	
		}	   

		public function get_roles() {

			$this->AdPost->setDataSource('cloudant_db');
			$roles = $this->AdPost->curlGet('axi_fxchng/role_2d7e8411c977679a8dade0f7c4b967c5');
			
			$this->set(array(
	            'AdPost' => $roles,
	            '_serialize' => array('AdPost')
	        ));
			
		 	
		}

		public function common_friend($current_user_fb_id = null,$ad_makers_fb_id = null) {
		$limit=1;
		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q=*:*&sort="-sort_time"&include_docs=true&limit='.$limit);
        $final_all_ads = array();
	 		foreach ($items['rows'] as $value) {
				$ad_makers_fb_id = 1065089253519;
				$current_user_fb_id = 50037449011229;

				$current_user_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $current_user_fb_id),
						'fields' => array('fb_name')
					));
				$ad_maker_friends_fb_id = $this->FbFriend->find('all', array(
						'conditions' => array('user_fb_id' => $ad_makers_fb_id),
						'fields' => array('fb_name')
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
				$this->set(array(
		            'FbFriend' => $common_frnds_fb_id,
		            '_serialize' => array('FbFriend')
		        ));
			 }
		 	
         }

         public function mutual_friend($current_user_fb_id = null,$ad_fb_id = null) {
		    // set mutual friend details
	    	$current_user_fb_id = 50037449011229;
	    	$ad_fb_id = $ad_fb_id;
			$user_friends_details = $this->FbFriend->find('all', array('conditions' => array('user_fb_id' => $current_user_fb_id)));

			$user_fb_id = array();
	       	foreach ($user_friends_details as $key => $value) {
	   			array_push($user_fb_id, $value['FbFriend']['fb_id']);
	       	}

	       	$mutual_friend_details = array();
	       	foreach ($user_fb_id as $fb_id) {
	       		$tmp_detials = $this->User->find('first', array('fields' => array('fb_name', 'fb_profilepic', 'fb_id'), 'conditions' => array('fb_id' => $fb_id)));

				if ($tmp_detials != null) {
					$tmp_mutual_friend_details['mutual_friend_fb_id'] = $tmp_detials['User']['fb_id'];
		       		$tmp_mutual_friend_details['mutual_friend_name'] = $tmp_detials['User']['fb_name'];
		       		$tmp_mutual_friend_details['mutual_friend_pic'] = $tmp_detials['User']['fb_profilepic'];
		       		// $tmp_mutual_friend_details['ad_detial'] = $ad_detail;
		       		// $tmp_mutual_friend_details['mutual_friend_ad_details'] = $ad_id;
		       		array_push($mutual_friend_details, $tmp_mutual_friend_details);
				}
	       	}
	       	$this->set(array(
		            'User' => $mutual_friend_details,
		            '_serialize' => array('User')
		        ));
	    }
  
}   
        
?>