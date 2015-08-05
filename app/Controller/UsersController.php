<?php
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
	var $helpers = array('Html', 'Js');
	var $uses = array('User', 'login', 'FbFriend');

	public function beforeFilter() {
		parent::beforeFilter();
       	$this->response->header('Access-Control-Allow-Origin','*');
       	$this->response->header('Access-Control-Allow-Methods','*');

		AppController::beforeFilter();

		// Basic setup
		$this->Auth->authenticate = array('Form');

		// Pass settings in
		$this->Auth->authenticate = array(
			'Form' => array('userModel' => 'User')
		);

		$this->Auth->allow('login', 'callback', 'logout', 'set_user_pic');

		//Set the overall layout
		$this->layout = 'main';
	}

	public function callback($token = null) {
		$is_new_user = "";
		$this->layout = 'ajax';

		if($this->request->is('post')) {
			$flag = ""; // success or failure
			$is_new_user = 0;
			$auth_details = $this->request->data;

			// save user details if new
			$newUser = array();

			$newUser['User']['fb_token'] = $token;
			$newUser['User']['fb_id'] = $auth_details['id'];
			$newUser['User']['fb_name'] = $auth_details['name'];
			$newUser['User']['fb_profilepic'] = 'https://graph.facebook.com/'.$auth_details['id'].'/picture?type=square';
			$newUser['User']['first_name'] = $auth_details['first_name'];
			$newUser['User']['last_name'] = $auth_details['last_name'];
			$newUser['User']['username'] = $auth_details['email'];
			$newUser['User']['password'] = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
			$newUser['User']['fb_gender'] = $auth_details['gender'];
			$newUser['User']['fb_link'] = $auth_details['link'];
			$newUser['User']['fb_verified'] = $auth_details['verified'];
			if (isset($auth_details['birthday'])) {
				$newUser['User']['fb_birthday'] = $auth_details['birthday'];
			}

			// $newUser['User']['fb_link'] = $auth_details['auth']['raw']['link'];
			// $newUser['User']['fb_mobile_verify'] = $auth_details['auth']['raw']['verified'];

			$fb_id = $auth_details['id'];

			$user = $this->User->findByFbId($fb_id);

			// set id if already exist.
			if(sizeof($user) > 0) {
				$newUser['User']['id'] = $user['User']['id'];
				$newUser['User']['is_exist'] = 1; // set 1 if exist
				$is_new_user = 1;
			}
			else {
				$newUser['User']['is_exist'] = 0; // set 0 if not exist
				$is_new_user = 0;
			}

			// save/update user details
			if($this->User->save($newUser)) {

				if (isset($auth_details['context']['mutual_friends'])) {

					// check size greater than zero then proceed.
					if (!empty($auth_details['context']['mutual_friends']['data'])) {

						// delete all mutual friends then add again
						if(!$this->FbFriend->deleteAll(array('user_fb_id' => $newUser['User']['fb_id']))) {
							$flag = 'from deleteAll';
						}

						// loop to all mutual friends and save
						$fb_friends = array();

						foreach ($auth_details['context']['mutual_friends']['data'] as $key => $value) {
							$temp = array();
							// $temp['FbFriend']['user_id'] = $newUser['User']['id'];
							$temp['FbFriend']['user_fb_id'] = $newUser['User']['fb_id'];
							$temp['FbFriend']['fb_id'] = $value['id'];
							$temp['FbFriend']['fb_name'] = $value['name'];
							$temp['FbFriend']['total_count'] = $auth_details['context']['mutual_friends']['summary']['total_count'];
							array_push($fb_friends, $temp);
						}

						// save mutual friend list into table
						if (!$this->FbFriend->saveMany($fb_friends)) {
							$flag= 'failure from FbFriend';
						}
					}
				}

				// login user and set session
				if($this->Auth->login($newUser['User'])) {
					$flag = 'success';
				}
				else {
					$flag= 'failure from auth login';
				}
			}
			else {
				$flag= 'failure from SAVE';
			} // end of Save/update method

			// send success or failure message to ajax
			if ($is_new_user == 0) {

				// read auth again for get active user details
				$this->activeUser = $this->Session->read('Auth');
				// send welcome message to current user
				$Email = new CakeEmail('default');
				// set variable values
				$Email->viewVars(array('name' => $this->activeUser['User']['fb_name']));
				// set format html/text or both
				$Email->emailFormat('html');
				// $Email->from(array('bhaumik.gandhi@actonate.com' => 'Actonate'));
				$Email->subject('Welcome To Fxchng');
				$Email->template('welcome', 'fxchng'); // welcome template and fxchng layout
       			$Email->to($this->activeUser['User']['username']);
				$Email->send();
				// find his connections and inform them too.
				$user_friends_details = $this->FbFriend->find('all', array('conditions' => array('user_fb_id' => $this->activeUser['User']['fb_id'])));

				if ($user_friends_details) {

					$user_fb_id = array();
			       	foreach ($user_friends_details as $key => $value) {
		       			array_push($user_fb_id, $value['FbFriend']['fb_id']);
			       }
			       // find user_friends_email
			       $user_friends = array();
			       	foreach ($user_fb_id as $value) {

			       		if ($value != null) {

			       			$friend_details = $this->User->findByFbId($value);
		       				$tmp_array['name'] = $friend_details['User']['fb_name'];
		       				$tmp_array['email'] = $friend_details['User']['username'];
					       	array_push($user_friends, $tmp_array);
					    }
			       	}
			       	// pr($user_friends);die();
			       	// send mail to all mutual friends
			       	foreach ($user_friends as $value) {

			       		if ($value != null) {

			       			$Email = new CakeEmail('default');
							// set variable values
							$Email->viewVars(array('name' => $value['name'], 'friend_name' => $this->activeUser['User']['fb_name']));
							// set format html/text or both
							$Email->emailFormat('html');
							// $Email->from(array('bhaumik.gandhi@actonate.com' => 'Actonate'));
							$Email->subject('Fxchng support');
							$Email->template('welcome_inform', 'fxchng'); // welcome template and fxchng layout
			       			$Email->to($value['email']);
							$Email->send();
			       		}
			       }
				}
				echo 0; // send to ajax if new user
			}
			else {
				echo 1; // send to ajax if existing user
			}

		} // end of is request is post condition
	} // end of callback method

	public function logout() {
        // Logout using auth component
        if($this->Auth->logout()) {
        	// Display success message and redirect
            $this->Session->setFlash('Successfully logged out !','default',array('class' =>'alert alert-success'),'success');
            // $this->redirect($this->referer());
            $this->redirect(array('controller'=>'home', 'action' => 'index'));
        } else {
            // Display failure message and redirect
           	$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            // $this->redirect($this->referer());
            $this->redirect(array('controller'=>'home', 'action' => 'index'));
        }
    } // end of logout method

    public function set_user_pic() {
    	$this->layout = 'ajax_layout';
    }
} // end of main class
?>