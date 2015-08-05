<?php
include_once('../Plugin/sms_engine/sms.php');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class CategoriesController extends AppController {
    public $components = array('RequestHandler');
	public $uses = array('Category','ItemCategory', 'Brand', 'Role', 'AutoModel', 'AdPost', 'ItemPhoto', 'ItemType', 'SetAdReply');
	public $helpers = array('Html', 'Js', 'Form');

	public function beforeFilter() {

	AppController::beforeFilter();

		$this->Auth->allow('make_an_offer','index', "index_ajax", "product_detail", 'sub_category_items', 'sub_category_items_ajax', 'get_type_filter_data', 'get_category_filter_data', 'set_ad_reply', 'get_help', 'set_common_friends');

		// set datasource
	//	$this->AdPost->setDataSource('cloudant_db');

		// Set the overall layout
		$this->layout = 'main';

		// set title
		$title = "Categories";
     	$this->set('title_for_layout',$title);
	}

	// displays items by item types
	public function index($id = null) {

		$staff = $this->ItemType->find('first');
	        //$Users = Set::extract('/User/.', $Users);
	        $this->set(array(
	            'ItemType' => $staff,
	            '_serialize' => array('ItemType')
	        ));
	    }

	       // pr($staff);die();
	        

		// set page for infinite scroll
	 
}
?>