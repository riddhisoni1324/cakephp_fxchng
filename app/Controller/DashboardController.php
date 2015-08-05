<?php
class DashboardController extends AppController {
	public $helpers = array('Html', 'Js', 'Form');
	public $uses = array('ItemCategory', 'Brand', 'Role', 'AutoModel', 'AdPost', 'ItemPhoto', 'ItemType', 'FbFriend');

	public function beforeFilter() {
		AppController::beforeFilter();

		$this->Auth->allow('index', "my_alert", "my_ads", 'profile', 'shortlist', 'my_alert', 'get_active_ads', 'get_completed_ads', 'get_expired_ads');

		// set datasource
		$this->AdPost->setDataSource('cloudant_db');

		// Set the overall layout
		$this->layout = 'main';

		// set title
		$title = "Dashboard";
     	$this->set('title_for_layout',$title);
	}

	public function index() {

		if($this->activeUser) {
			// set my active ads
			$fb_id = $this->activeUser['User']['fb_id'];
			$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/my_ad_list?startkey=["'.$fb_id.'",%200,%20%20"active"]&endkey=["'.$fb_id.'",%200,%20%20"active,{}"]&include_docs=true');
			$this->set('items' ,$items['rows']);
			// set my alerts
			$fb_id = $this->activeUser['User']['fb_id'];
			$my_alerts = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/msg_by_fb_id?key="'.$fb_id.'"&include_docs=true&sort_by="-created_timestamp"');
			$this->set('my_alerts' ,$my_alerts['rows']);

			// get total_count of current user
			$total_count = $this->FbFriend->find('all', array('conditions' => array('user_fb_id' => $this->activeUser['User']['fb_id']), 'fields' => 'total_count'));
			$network['count'] = count($total_count);
			$network['total'] = $total_count[0]['FbFriend']['total_count'];
			$this->set('network', $network);
		}
	}

	public function my_ads($fb_id = null) {

		if($this->activeUser) {

			//set fb_id for ajax
			$this->set('fb_id', $fb_id);

			// set not completed ads -
			// get all ads on descending order with is_complete = 0 and status = 'active'
			// and current user_fb_id
			$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/my_ad_list?startkey=["'.$fb_id.'",%200,%20%20"active"]&endkey=["'.$fb_id.'",%200,%20%20"active,{}"]&include_docs=true');
			$this->set('items' ,$items['rows']);
			// pr($items);
			// echo sizeof($items['rows']);
			$this->set('total_ads', sizeof($items['rows']));

		}
	}

	public function get_active_ads($fb_id = null) {

		if ($this->activeUser!= null) {

			$this->layout = 'ajax_layout';
			$this->set('fb_id', $fb_id);

			$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/my_ad_list?startkey=["'.$fb_id.'",%200,%20%20"active"]&endkey=["'.$fb_id.'",%200,%20%20"active,{}"]&include_docs=true');
			$this->set('items' ,$items['rows']);

			// count total ads
			$this->set('total_ads', sizeof($items['rows']));

			// echo json_encode($items);
		}
	}

	public function get_completed_ads($fb_id = null) {

		$this->layout = 'ajax_layout';
		$this->set('fb_id', $fb_id);

		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/my_ad_list?startkey=["'.$fb_id.'",%201,%20%20"active"]&endkey=["'.$fb_id.'",%201,%20%20"active,{}"]&include_docs=true');
		$this->set('items' ,$items['rows']);

		// count total ads
		$this->set('total_ads', sizeof($items['rows']));

	}

	public function get_expired_ads($fb_id = null) {

		$this->layout = 'ajax_layout';
		$this->set('fb_id', $fb_id);

		$items = $this->AdPost->curlGet('axi_fxchng/_design/ad/_view/my_ad_list?startkey=["'.$fb_id.'",%200,%20%20"deactive"]&endkey=["'.$fb_id.'",%200,%20%20"deactive,{}"]&include_docs=true');
		$this->set('items' ,$items['rows']);

		// count total ads
		$this->set('total_ads', sizeof($items['rows']));

	}

	public function profile() {
  		if($this->activeUser != null){

			$id=$this->activeUser['User']['fb_id'];
			$user=$this->User->findByFbId($id);
			$this->set('user',$user);
       }
       else { echo 'not logged in'; }

       if($this->request->is('post'))
       {
       		$this->User->id=$this->activeUser['User']['id'];

       		$data=$this->request->data;

			if($this->User->save($data)) {
			//	pr($user);
       		  $this->Session->setFlash('Successfully Added !','default',array('class' =>'alert alert-success'),'success');
	          //$this->redirect($this->referer());
	         }
	         else {
	         		$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                //    $this->redirect($this->referer());
	         }
       }
	}

	public function shortlist() {
	}
}
?>