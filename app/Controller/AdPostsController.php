<?php
	App::uses('CakeTime', 'Utility');
	App::uses('CakeEmail', 'Network/Email');
	class AdPostsController extends AppController {

		public $uses = array('ItemCategory', 'Brand', 'Role', 'AdPost', 'ItemPhoto', 'ItemType', 'Cloudant');
		public $helpers = array('Html', 'Js');

		public function beforeFilter() {

		AppController::beforeFilter();

			$this->Auth->allow("index", 'edit_post', 'posted', "get_item_categories", 'get_brands', 'get_models', 'get_cities', 'get_states', 'get_areas', 'live_at_cloudant', 'get_data');

			// set datasource
			$this->AdPost->setDataSource('cloudant_db');

			// Set the overall layout
			$this->layout = 'main';

			// set title
			$title = "ad_post";
	     	$this->set('title_for_layout',$title);
		}

		public function live_at_cloudant() {
			$fxchng_datas = $this->Cloudant->find('all');
			// pr($fxchng_datas);die();
			$count=0;
			$cloudant_array = array();
			foreach ($fxchng_datas as $fxchng_data) {
				$guid = String::uuid();

				// get todays datetime in seconds
				$time_in_seconds =  CakeTime::convert(time(), new DateTimeZone('Asia/Calcutta'));

				// set final id for array
				$id = "ad_".$time_in_seconds.'_'.$guid;

				$item_data = $this->data;
				// pr($item_data);die();
				// final Array for cloudant
				$final_aray = array();

				$final_aray['_id'] = $id;
				$final_aray['doc_type'] = 'ad';
				$final_aray['fb_id'] = $fxchng_data['Cloudant']['fb_id'];

				$final_aray['created_timestamp'] = $time_in_seconds*1000;

				$final_aray['i_want_to'] = $fxchng_data['Cloudant']['i_want_to'];
				$final_aray['job_type'] = "";
				$final_aray['condition'] = $fxchng_data['Cloudant']['condition'];

				$final_aray['item_type']['id'] = $fxchng_data['Cloudant']['type_id'];
				$final_aray['item_type']['name'] = $fxchng_data['Cloudant']['type_name'];

				$final_aray['item_category']['id'] = $fxchng_data['Cloudant']['sub_cat_id'];
				$final_aray['item_category']['name'] = $fxchng_data['Cloudant']['sub_cat_name'];

				$final_aray['brand']['id'] = "";
				$final_aray['brand']['name'] = "";

				$final_aray['jobs']['Role']['id'] = "";
				$final_aray['jobs']['Role']['name'] = "";
				$final_aray['jobs']['company_name'] = "";
				$final_aray['jobs']['designation'] = "";
				$final_aray['jobs']['education'] = "";
				$final_aray['jobs']['experience'] = "";
				$final_aray['jobs']['key_skills'] = "";

				$final_aray['year'] = "";
				$final_aray['kms_driven'] = "";
				$final_aray['fuel_type'] = "";
				$final_aray['valid_till'] = "";
				$final_aray['vehicle_type'] = "";
				$final_aray['event_date'] = "";
				$final_aray['venue'] = "";

				$final_aray['real_estate']['area'] = "";
				$final_aray['real_estate']['city'] = "";
				$final_aray['real_estate']['locality'] = "";

				$final_aray['title'] = $fxchng_data['Cloudant']['title'];
				$final_aray['description'] = $fxchng_data['Cloudant']['description'];

				$final_aray['price'] = (int)$fxchng_data['Cloudant']['price'];

				$final_aray['negotiable'] = 0;
				$final_aray['usage'] = "";

				$final_aray['is_deleted'] = 0;
				$final_aray['is_completed'] = 0;
				$final_aray['status'] = 'active';

				$final_aray['visitors'] = $fxchng_data['Cloudant']['visiter_count'];


				$final_aray['personal_info']['you_are/i_am'] = $fxchng_data['Cloudant']['countyid'];
				$final_aray['personal_info']['name'] = $fxchng_data['Cloudant']['fb_name'];
				$final_aray['personal_info']['mobile'] = $fxchng_data['Cloudant']['mobile'];
				$final_aray['personal_info']['email'] = $fxchng_data['Cloudant']['username'];
				$final_aray['personal_info']['city'] = $fxchng_data['Cloudant']['city_name'];
				$final_aray['personal_info']['area'] = "";
				$final_aray['personal_info']['fb_id'] = $fxchng_data['Cloudant']['fb_id'];
				$final_aray['personal_info']['fb_pic'] = $fxchng_data['Cloudant']['fb_link'].'picture?type=square';
				$final_aray['personal_info']['fb_link'] = $fxchng_data['Cloudant']['fb_link'];

				// Set created and modified timestamp
	            date_default_timezone_set('Asia/Calcutta');
	            $todays = new DateTime();

				$final_aray['created'] = $todays->format('Y-m-d H:i:s');
				$final_aray['modified'] = $todays->format('Y-m-d H:i:s');

				// Set created and modified timestamp
	            date_default_timezone_set('Asia/Calcutta');
	            $todays = new DateTime();

				$final_aray['created'] = $todays->format('Y-m-d H:i:s');
				$final_aray['modified'] = $todays->format('Y-m-d H:i:s');

				array_push($cloudant_array, json_encode($final_aray));
			}

			echo json_encode($cloudant_array);die();
			// pr($cloudant_array); die();
			// if(!$this->AdPost->save($final_aray)) {
			// 	pr($cloudant_array);
			// 	die();
			// }
			// $items = $this->AdPost->curlPost('axi_fxchng/_bulk_docs');
			// $this->AdPost->curlPost('axi_fxchng/_bulk_docs', array('docs' => $temp));
			// die('finish');
		}

		public function get_data($data=null) {

			$this->layout = 'ajax';
			if ($this->request->is('post')) {
				$data = $this->request->input(json_decode($data, true));
			}

		}

		public function index() {

			if ($this->request->is('post')) {

				// get uuid
				$guid = String::uuid();

				// get todays datetime in seconds
				$time_in_seconds =  CakeTime::convert(time(), new DateTimeZone('Asia/Calcutta'));

				// set final id for array
				$id = "ad_".$time_in_seconds.'_'.$guid;

				$item_data = $this->data;

				// final Array for cloudant
				$final_aray = array();

				$final_aray['id'] = $id;
				$final_aray['doc_type'] = 'ad';
				$final_aray['fb_id'] = $this->activeUser['User']['fb_id'];

				$final_aray['created_timestamp'] = $time_in_seconds*1000;

				$final_aray['i_want_to'] = $item_data['i_want_to'];
				$final_aray['job_type'] = $item_data['job_type'];
				$final_aray['condition'] = $item_data['condition'];

				$final_aray['item_type']['id'] = $item_data['ItemType']['id'];
				$final_aray['item_type']['name'] = $item_data['ItemType']['name'];

				// for resume
				if (!$item_data['ItemType']['resume_file']['size'] <= 0) {

					$filename = array();
	                $filename['resume_file']['name'] = $item_data['ItemType']['resume_file']['name'];
	                $filename['resume_file']['type'] = $item_data['ItemType']['resume_file']['type'];
	                $filename['resume_file']['tmp_name'] = $item_data['ItemType']['resume_file']['tmp_name'];
	                $filename['resume_file']['size'] = $item_data['ItemType']['resume_file']['size'];
	                $filename['resume_file']['error'] = $item_data['ItemType']['resume_file']['error'];

	                $filename['guid'] = $id;

	                if(!$this->ItemPhoto->save($filename)) {

	                	$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
	                	$this -> redirect(array('controller' => 'ad_posts', 'action' => 'index'));
	                }
	                else {
	                	$last_uploaded_resume = $this->ItemPhoto->findByGuid($id);
	                	$final_aray['resume'] = $last_uploaded_resume['ItemPhoto']['id']."/".$last_uploaded_resume['ItemPhoto']['resume_file'];
	                }

				} // end of resume

				// check photo uploaded or not
				if (!$item_data['ItemType']['image_files'][0]['size'] <= 0) {

					// save images in sql database
					$item_photo_details = array();

					// loop each uploaded images
		            foreach($item_data['ItemType']['image_files'] as $value) {

		        	 	$filename = array();
		                $filename['image_file']['name'] = $value['name'];
		                $filename['image_file']['type'] = $value['type'];
		                $filename['image_file']['tmp_name'] = $value['tmp_name'];
		                $filename['image_file']['size'] = $value['size'];
		                $filename['image_file']['error'] = $value['error'];

		                $filename['guid'] = $id;

		                array_push($item_photo_details, $filename);
		            }

	             	if($this->ItemPhoto->saveMany($item_photo_details)) {

	             		// get current uploaded photos
	                	$last_uploaded_images = $this->ItemPhoto->find('all',array('conditions'=>array('guid' => $id), 'order'=>'created'));

	                	$count = 0;
	                	$primary_photo = array(); // for save primary photo
                		$photos = array(); // for save other photos
                		$tmp_photo = array();
	                	foreach ($last_uploaded_images as $value) {

	                		// for photos
	                		if($count == 0) {

	                			$primary_photo['filename'] = $value['ItemPhoto']['image_file'];
	                			$primary_photo['dir'] = $value['ItemPhoto']['id'];

	                			// add photos array into final_aray
	                			$final_aray['primary_photo'] = $primary_photo;
	                			//array_push($final_aray, $primary_photo);
	                		}
	                		else {

	                			$tmp_photo['filename'] = $value['ItemPhoto']['image_file'];
	                			$tmp_photo['dir'] = $value['ItemPhoto']['id'];
	                			array_push($photos, $tmp_photo);
	                		}

	                		$count++;
	                	}
	                	$final_aray['photo'] = $photos;
		            }
		            else {
		                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
	                	$this -> redirect(array('controller' => 'ad_posts', 'action' => 'index'));
		            }
				} // end of photo


				//pr($final_aray);

				$final_aray['item_category']['id'] = $item_data['ItemCategory']['id'];
				$final_aray['item_category']['name'] = $item_data['ItemCategory']['name'];

				$final_aray['brand']['id'] = $item_data['brand']['id'];
				$final_aray['brand']['name'] = $item_data['brand']['name'];

				// find included item name
				if(isset($item_data['included'])) {
					$included = 0;
					$item = "";
					foreach ($item_data['included'] as $key => $value) {
						if ($key === 'charger') {
							$item = 'Charger';
						}
						else if ($key === 'data_cabel') {
							$item = 'Data Cabel';
						}
						else if ($key === 'ear_phone') {
							$item = 'Ear Phone/Head Phone';
						}
						else if ($key === 'memory_card') {
							$item = 'Memory Card';
						}
						else if ($key === 'others') {
							$item = 'Other';
						}
						$final_aray['included'][$included] = $item;
						$included++;
					} // end of included
				}

				$final_aray['jobs']['Role']['id'] = $item_data['Role']['id'];
				$final_aray['jobs']['Role']['name'] = $item_data['Role']['name'];
				$final_aray['jobs']['company_name'] = $item_data['company_name'];
				$final_aray['jobs']['designation'] = $item_data['designation'];
				$final_aray['jobs']['education'] = $item_data['education'];
				$final_aray['jobs']['experience'] = $item_data['experience'];
				$final_aray['jobs']['key_skills'] = $item_data['key_skills'];

				// $final_aray['auto_model']['id'] = $item_data['AutoModel']['id'];
				// $final_aray['auto_model']['name'] = $item_data['AutoModel']['name'];

				$final_aray['year'] = $item_data['year'];
				$final_aray['kms_driven'] = $item_data['kms_driven'];
				$final_aray['fuel_type'] = $item_data['fuel_type'];
				$final_aray['valid_till'] = $item_data['valid_till'];
				$final_aray['vehicle_type'] = $item_data['vehicle_type'];
				$final_aray['event_date'] = $item_data['event_date'];
				$final_aray['venue'] = $item_data['venue'];

				$final_aray['real_estate']['area'] = $item_data['area'];
				$final_aray['real_estate']['city'] = $item_data['city'];
				$final_aray['real_estate']['locality'] = $item_data['locality'];

				$final_aray['title'] = $item_data['title'];
				$final_aray['description'] = $item_data['desc'];

				$final_aray['price'] = (int)$item_data['price'];
				$final_aray['negotiable'] = $item_data['negotiable'];
				$final_aray['usage'] = $item_data['how_old'];
				$final_aray['is_deleted'] = 0;
				$final_aray['is_completed'] = 0;
				$final_aray['status'] = 'active';

				$final_aray['personal_info']['you_are/i_am'] = $item_data['youare'];
				$final_aray['personal_info']['name'] = $item_data['name'];
				$final_aray['personal_info']['mobile'] = $item_data['mobile'];
				$final_aray['personal_info']['email'] = $item_data['email'];
				$final_aray['personal_info']['area'] = $item_data['personal_area'];
				$final_aray['personal_info']['city'] = $item_data['personal_city'];
				$final_aray['personal_info']['fb_id'] = $this->activeUser['User']['fb_id'];
				$final_aray['personal_info']['fb_pic'] = $this->activeUser['User']['fb_profilepic'];
				$final_aray['personal_info']['fb_link'] = $this->activeUser['User']['fb_link'];

				// Set created and modified timestamp
	            date_default_timezone_set('Asia/Calcutta');
	            $todays = new DateTime();

				$final_aray['created'] = $todays->format('Y-m-d H:i:s');
				$final_aray['modified'] = $todays->format('Y-m-d H:i:s');

				if($this->AdPost->save($final_aray)) {

					// send thank you message to current user
					$Email = new CakeEmail('default');
					// set variable values
					$Email->viewVars(array('name' => $this->activeUser['User']['fb_name'], 'title' => $final_aray['title']));
					// set format html/text or both
					$Email->emailFormat('html');
					$Email->subject('Fxchng support');
					$Email->template('thank_you', 'fxchng'); // welcome template and fxchng layout
	       			$Email->to($this->activeUser['User']['username']);
					$Email->send();
					// redirect to thank you page
					return $this->redirect(array('controller' => 'ad_posts', 'action' => 'posted', $final_aray['id']));
				} else {
					$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            		$this->redirect($this->referer());
				}

			}

			// get item types
			$item_types = $this->ItemType->find('list', array('order'=> array('sort_order'), 'conditions' => array('is_active' => '1')));
			$this->set('item_types', $item_types);

			// get Role list
			// $roles = $this->Role->find('list', array('order'=> array('Role.name')));
			$roles = $this->AdPost->curlGet('axi_fxchng/role_2d7e8411c977679a8dade0f7c4b967c5');
			$this->set('roles', $roles['role']);

			$user_data = $this->activeUser;
			$this->set('user_data', $user_data);
		}

		public function posted($ad_id) {
			// get last inserted ad_id of current user
			// $find_result = 'by_fb_id:"'.$this->activeUser['User']['fb_id'].'"';
			// $post = $this->AdPost->curlGet('axi_fxchng/_design/ad/_search/adSearch?q='.$find_result.'&sort=%22-sort_time%22&include_docs=true&limit=1');

			// $ad_id = $post['rows'][0]['doc']['_id'];
			// pr($ad_id);
			// set ad_id
			$this->set('ad_id', $ad_id);
		}

		public function edit_post($id = null) {
			$files_aaray = array();
			// get item types
			$item_types = $this->ItemType->find('list', array('order'=> array('sort_order')));
			$this->set('item_types', $item_types);

			// get Role list
			$roles = $this->AdPost->curlGet('axi_fxchng/role_2d7e8411c977679a8dade0f7c4b967c5');
			$this->set('roles', $roles['role']);

			$user_data = $this->activeUser;
			$this->set('user_data', $user_data);

			// get last inserted ad_id of current user
			$ad_details = $this->AdPost->curlGet('axi_fxchng/'.$id);
			$this->set('ad_details' ,$ad_details);
		 // 	// pr($ad_details);

			// // check resume
			// if (isset($ad_details['resume'])) {
			// 	if($ad_details['resume'] != null) {
			// 		$files_aaray['resume'] = $ad_details['resume'];
			// 	}
			// }

			// // check photos
			// if(isset($ad_details['primary_photo'])) {

			// 	if($ad_details['primary_photo']['filename'] != null) {
			// 		$files_aaray['primary_photo']['filename'] = $ad_details['primary_photo']['filename'];
			// 		$files_aaray['primary_photo']['dir'] = $ad_details['primary_photo']['dir'];
			// 	}

			// 	if(sizeof($ad_details['photo']) > 0) {
			// 		$outer_temp = array();
			// 		foreach ($ad_details['photo'] as $avail_photo) {
			// 			$tmp_photo = array();
			// 			$tmp_photo['filename'] = $avail_photo['filename'];
			// 			$tmp_photo['dir'] = $avail_photo['dir'];
			// 			array_push($outer_temp, $tmp_photo);
			// 		}
			// 		$files_aaray['photo'] = $outer_temp;
			// 	}
			// }
			// $this->set('saved_paths', $files_aaray);

			if ($this->request->is('post')) {

				// get uuid
				$guid = String::uuid();

				// get todays datetime in seconds
				$time_in_seconds =  CakeTime::convert(time(), new DateTimeZone('Asia/Calcutta'));

				// set final id for array
				 $id = "ad_1435730552_55938278-9a78-4086-ba8d-378e52d40771";

				$item_data = $this->data;

				// final Array for cloudant
				$final_aray = array();

				$final_aray['id'] = $id;
				// $final_aray['doc_type'] = 'ad';
				$final_aray['fb_id'] = $this->activeUser['User']['fb_id'];

				// $final_aray['created_timestamp'] = $time_in_seconds*1000;

				$final_aray['i_want_to'] = $item_data['i_want_to'];
				$final_aray['job_type'] = $item_data['job_type'];
				$final_aray['condition'] = $item_data['condition'];

				// $final_aray['item_type']['id'] = $item_data['ItemType']['id'];
				$final_aray['item_type']['name'] = $item_data['ItemType']['name'];

				// for resume
				// if (!$item_data['ItemType']['resume_file']['size'] <= 0) {

				// 	$filename = array();
	   //              $filename['resume_file']['name'] = $item_data['ItemType']['resume_file']['name'];
	   //              $filename['resume_file']['type'] = $item_data['ItemType']['resume_file']['type'];
	   //              $filename['resume_file']['tmp_name'] = $item_data['ItemType']['resume_file']['tmp_name'];
	   //              $filename['resume_file']['size'] = $item_data['ItemType']['resume_file']['size'];
	   //              $filename['resume_file']['error'] = $item_data['ItemType']['resume_file']['error'];

	   //              $filename['guid'] = $id;

	   //              if(!$this->ItemPhoto->save($filename)) {

	   //              	$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
	   //              	$this -> redirect(array('controller' => 'ad_posts', 'action' => 'index'));
	   //              }
	   //              else {
	   //              	$last_uploaded_resume = $this->ItemPhoto->findByGuid($id);
	   //              	$final_aray['resume'] = $last_uploaded_resume['ItemPhoto']['id']."/".$last_uploaded_resume['ItemPhoto']['resume_file'];
	   //              }

				// } // end of resume

				// check photo uploaded or not
				// if (!$item_data['ItemType']['image_files'][0]['size'] <= 0) {

				// 	// save images in sql database
				// 	$item_photo_details = array();

				// 	// loop each uploaded images
		  //           foreach($item_data['ItemType']['image_files'] as $value) {

		  //       	 	$filename = array();
		  //               $filename['image_file']['name'] = $value['name'];
		  //               $filename['image_file']['type'] = $value['type'];
		  //               $filename['image_file']['tmp_name'] = $value['tmp_name'];
		  //               $filename['image_file']['size'] = $value['size'];
		  //               $filename['image_file']['error'] = $value['error'];

		  //               $filename['guid'] = $id;

		  //               array_push($item_photo_details, $filename);
		  //           }

	   //           	if($this->ItemPhoto->saveMany($item_photo_details)) {

	   //           		// get current uploaded photos
	   //              	$last_uploaded_images = $this->ItemPhoto->find('all',array('conditions'=>array('guid' => $id), 'order'=>'created'));

	   //              	$count = 0;
	   //              	$primary_photo = array(); // for save primary photo
    //             		$photos = array(); // for save other photos
    //             		$tmp_photo = array();
	   //              	foreach ($last_uploaded_images as $value) {

	   //              		// for photos
	   //              		if($count == 0) {

	   //              			$primary_photo['filename'] = $value['ItemPhoto']['image_file'];
	   //              			$primary_photo['dir'] = $value['ItemPhoto']['id'];

	   //              			// add photos array into final_aray
	   //              			$final_aray['primary_photo'] = $primary_photo;
	   //              			//array_push($final_aray, $primary_photo);
	   //              		}
	   //              		else {

	   //              			$tmp_photo['filename'] = $value['ItemPhoto']['image_file'];
	   //              			$tmp_photo['dir'] = $value['ItemPhoto']['id'];
	   //              			array_push($photos, $tmp_photo);
	   //              		}

	   //              		$count++;
	   //              	}
	   //              	$final_aray['photo'] = $photos;
		  //           }
		  //           else {
		  //               $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
	   //              	$this -> redirect(array('controller' => 'ad_posts', 'action' => 'index'));
		  //           }
				// } // end of photo


				//pr($final_aray);

				// $final_aray['item_category']['id'] = $item_data['ItemCategory']['id'];
				$final_aray['item_category']['name'] = $item_data['ItemCategory']['name'];

				$final_aray['brand']['id'] = $item_data['brand']['id'];
				$final_aray['brand']['name'] = $item_data['brand']['name'];

				// find included item name
				if(isset($item_data['included'])) {
					$included = 0;
					$item = "";
					foreach ($item_data['included'] as $key => $value) {
						if ($key === 'charger') {
							$item = 'Charger';
						}
						else if ($key === 'data_cabel') {
							$item = 'Data Cabel';
						}
						else if ($key === 'ear_phone') {
							$item = 'Ear Phone/Head Phone';
						}
						else if ($key === 'memory_card') {
							$item = 'Memory Card';
						}
						else if ($key === 'others') {
							$item = 'Other';
						}
						$final_aray['included'][$included] = $item;
						$included++;
					} // end of included
				}

				$final_aray['jobs']['Role']['id'] = $item_data['Role']['id'];
				$final_aray['jobs']['Role']['name'] = $item_data['Role']['name'];
				$final_aray['jobs']['company_name'] = $item_data['company_name'];
				$final_aray['jobs']['designation'] = $item_data['designation'];
				$final_aray['jobs']['education'] = $item_data['education'];
				$final_aray['jobs']['experience'] = $item_data['experience'];
				$final_aray['jobs']['key_skills'] = $item_data['key_skills'];

				// $final_aray['auto_model']['id'] = $item_data['AutoModel']['id'];
				// $final_aray['auto_model']['name'] = $item_data['AutoModel']['name'];

				// $final_aray['year'] = $item_data['year'];
				// $final_aray['kms_driven'] = $item_data['kms_driven'];
				// $final_aray['fuel_type'] = $item_data['fuel_type'];
				// $final_aray['valid_till'] = $item_data['valid_till'];
				// $final_aray['vehicle_type'] = $item_data['vehicle_type'];
				$final_aray['event_date'] = $item_data['event_date'];
				$final_aray['venue'] = $item_data['venue'];

				$final_aray['real_estate']['area'] = $item_data['area'];
				$final_aray['real_estate']['city'] = $item_data['city'];
				$final_aray['real_estate']['locality'] = $item_data['locality'];

				$final_aray['title'] = $item_data['title'];
				$final_aray['description'] = $item_data['desc'];

				$final_aray['price'] = (int)$item_data['price'];
				$final_aray['negotiable'] = $item_data['negotiable'];
				// $final_aray['usage'] = $item_data['how_old'];
				$final_aray['is_deleted'] = 0;
				$final_aray['is_completed'] = 0;
				$final_aray['status'] = 'active';

				$final_aray['personal_info']['you_are/i_am'] = $item_data['youare'];
				$final_aray['personal_info']['name'] = $item_data['name'];
				$final_aray['personal_info']['mobile'] = $item_data['mobile'];
				$final_aray['personal_info']['email'] = $item_data['email'];
				$final_aray['personal_info']['area'] = $item_data['personal_area'];
				$final_aray['personal_info']['city'] = $item_data['personal_city'];
				$final_aray['personal_info']['fb_id'] = $this->activeUser['User']['fb_id'];
				$final_aray['personal_info']['fb_pic'] = $this->activeUser['User']['fb_profilepic'];
				$final_aray['personal_info']['fb_link'] = $this->activeUser['User']['fb_link'];

				// Set created and modified timestamp
	            date_default_timezone_set('Asia/Calcutta');
	            $todays = new DateTime();

				$final_aray['created'] = $todays->format('Y-m-d H:i:s');
				$final_aray['modified'] = $todays->format('Y-m-d H:i:s');

				// $this->Post->id = 'ad_1435730552_55938278-9a78-4086-ba8d-378e52d40771';
				if($this->AdPost->save($final_aray)) {

					// send thank you message to current user
					$Email = new CakeEmail('default');
					// set variable values
					$Email->viewVars(array('name' => $this->activeUser['User']['fb_name'], 'title' => $final_aray['title']));
					// set format html/text or both
					$Email->emailFormat('html');
					$Email->subject('Fxchng support');
					$Email->template('thank_you', 'fxchng'); // welcome template and fxchng layout
	       			$Email->to($this->activeUser['User']['username']);
					$Email->send();
					// redirect to thank you page
					return $this->redirect(array('controller' => 'ad_posts', 'action' => 'posted', 'ad_1435730552_55938278-9a78-4086-ba8d-378e52d40771'));
				} else {
					$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            		$this->redirect($this->referer());
				}

			}
		}



		public function get_item_categories($id=null) {

			//set layout ajax
			$this->layout = "ajax";

			$item_categories = $this->ItemCategory->find('all', array(
					'conditions' => array('ItemCategory.item_type_id' => $id),
					'fields' => array('ItemCategory.id', 'ItemCategory.name')
				));

		 	if($item_categories) {

            $content = '<select name="data[ItemType][item_category_id]" class="required form-control custom-select" id="item_category_id" data-error="Item Category is required.">';

            $content .= '<option value="" >Select</option>';

            foreach ($item_categories as $categories) {
                $content .= '<option value="'.$categories['ItemCategory']['id'].'" >'.$categories['ItemCategory']['name'].'</option>';
            }

            $content .= '</select>';

	        } else {

	            $content = '<select name="data[ItemType][item_category_id]" class="required form-control custom-select" id="item_category_id" data-error="Item Category is required.">';
	            $content .= '<option value="" >Select</option>';
	            $content .= '</select>';

	        }
        	echo $content;
		}

		public function get_brands($cat_id = null ) {

			//set layout ajax
			$this->layout = "ajax";

			// $brands = $this->Brand->find('all', array(
			// 		'conditions' => array('Brand.item_type_id' => $id, 'Brnad.item_category_id' => $cat_id),
			// 		'fields' => array('Brand.id', 'Brand.name')
			// 	));
			$this->AdPost->setDataSource('cloudant_db');
			$brands = $this->AdPost->curlGet('axi_fxchng/_all_docs?key="brand_'.$cat_id.'"&include_docs=true');
			$this->set('brands' ,$brands);
		 	if($brands) {
           	 $content = '<select name="data[brand_id]" class="required form-control custom-select" id="brand_id">';
            $content .= '<option value="" >Select Brand</option>';
            foreach ($brands['rows'][0]['doc']['brand'] as $brand) {
                $content .= '<option value="'.$brand.'" >'.$brand.'</option>';
            }

            $content .= '</select>';

	        } else {

	            $content = '<select name="data[brand_id]" class="required form-control custom-select" id="brand_id" >';
	            $content .= '<option value="" >Select Brand</option>';
	            $content .= '</select>';

	        }

        	echo $content;
		}

		// public function get_models($id=null) {

		// 	//set layout ajax
		// 	$this->layout = "ajax";

		// 	$auto_models = $this->AutoModel->find('all', array(
		// 			'conditions' => array('AutoModel.brand_id' => $id),
		// 			'fields' => array('AutoModel.id', 'AutoModel.name')
		// 		));

		//  	if($auto_models) {

  //           $content = '<select name="data[model_id]" class="required form-control custom-select" id="model_id">';

  //           $content .= '<option value="" >Select</option>';

  //           foreach ($auto_models as $brand) {
  //               $content .= '<option value="'.$brand['AutoModel']['id'].'" >'.$brand['AutoModel']['name'].'</option>';
  //           }

  //           $content .= '</select>';

	 //        } else {

	 //            $content = '<select name="data[model_id]" class="required form-control custom-select" id="model_id" >';
	 //            $content .= '<option value="" >Select</option>';
	 //            $content .= '</select>';

	 //        }

  //       	echo $content;
		// }

		// get states from cloudant
		// public function get_states() {

		// 	//set layout ajax
		// 	$this->layout = "ajax";

		// 	$all_states = $this->AdPost->curlGet('axi_phoenix_replicated/_design/admin2/_view/states-view?include_docs=true');

		// 	$final_states = array();

		// 	foreach ($all_states['rows'] as $key => $value) {
		// 		array_push($final_states, $value['doc']['name']);
		// 	}

		//  	if($final_states) {

  //           $content = '<select name="data[personal_state]" class="required form-control custom-select">';

  //           $content .= '<option value="" >Select State</option>';

  //           foreach ($final_states as $state) {
  //               $content .= '<option value="'.$state.'" >'.$state.'</option>';
  //           }

  //           $content .= '</select>';

	 //        } else {

	 //            $content = '<select name="data[personal_state]" class="required form-control custom-select">';
	 //            $content .= '<option value="" >Select State</option>';
	 //            $content .= '</select>';

	 //        }

  //       	echo $content;
		// }

		// Get All cities from cloudant database for view custom data
		public function get_cities($name=null) {

			$this->layout = 'ajax';

			$all_cities = $this->AdPost->curlGet('axi_phoenix_replicated/_design/admin2/_search/newSearch?q=name:'.$name.'*&include_docs=true');
			$this->set('all_cities' ,$all_cities);

			$final_cities = array();

			foreach ($all_cities['rows'] as $key => $value) {

				$tmp_array = array();

				$tmp_array['city_name'] = $value['doc']['name'];
				$tmp_array['region'] = $value['doc']['region1'];

				array_push($final_cities, $tmp_array);
			}
			echo json_encode($final_cities);
		} // end of get_cities action

		// public function get_cities($name=null) {

		// 	$this->layout = 'ajax';

		// 	$all_areas = $this->AdPost->curlGet('axi_phoenix_replicated/_design/admin2/_search/newSearch?q=name:'.$name.'*&include_docs=true');
		// 	$this->set('all_areas' ,$all_areas);

		// 	$final_cities = array();

		// 	foreach ($all_areas['rows'] as $key => $value) {
		// 		array_push($final_cities, $value['doc']['name']);
		// 	}

		// 	echo json_encode($final_cities);
		// }

		public function get_areas($name=null) {

			$this->layout = 'ajax';

			$all_areas = $this->AdPost->curlGet('axi_phoenix_replicated/_design/admin3/_view/region_view?keys=%5B%22'.$name.'%22%5D&include_docs=true');
			$this->set('all_areas' ,$all_areas);

			$final_areas = array();

			foreach ($all_areas['rows'] as $key => $value) {
				array_push($final_areas, $value['doc']['name']);
			}

			echo json_encode($final_areas);
		}
	}
?>