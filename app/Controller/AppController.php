<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $uses = array('ItemType','User', 'FbFriend', 'Home', 'Category');

	public $components = array(
		'Session', 'Cookie',
		'Auth' => array(
		    'authenticate' => array(
		        'User' => array(
		            'userModel' => 'User',
		            'fields' => array(
		                'username' => 'username',
		                'password' => 'password'
		            )
		        )
		    )
		)
	);

	public function beforeFilter() {

	 	   //End of Site Url Login
	        // $this->Auth->loginRedirect = array('controller' => 'homes', 'action' => 'index');
	        // $this->Auth->logoutRedirect = array('controller' => 'homes', 'action' => 'index');
	        // $this->Auth->loginAction = array('controller' => 'homes', 'action' => 'index');

			parent::beforeFilter();
	       	$this->response->header('Access-Control-Allow-Origin','*');
	       	$this->response->header('Access-Control-Allow-Methods','*');

	        //Logged In user variables
	        $this->set('isLoggedIn',$this->Auth->loggedIn());
	        $this->set('activeUser',$this->Session->read('Auth'));

	        $this->activeUser = $this->Session->read('Auth');
	        $this->isLoggedIn = $this->Auth->loggedIn();

	       $item_types = $this->ItemType->find('all', array('conditions' => array('ItemType.is_active' => 1) ,'order' => array('ItemType.sort_order ASC', 'ItemType.name')));
	       $this->set('main_nav_items', $item_types);

	       // set image path for Item Type
	       $path = $this->set('item_image', $this->base.'/polkadot/files/item_type/image_file/');

	       // if user logged in then set FB_ID.
	       if ($this->activeUser) {
	       	$FB_ID = $this->activeUser['User']['fb_id'];
	       }
	       else {
	       	$FB_ID = null;
	       }
	       $this->set('FB_ID', $FB_ID);

	       // set path for ad_post photos and resumes
	       $this->set('PHOTO_PATH', '/files/item_photo/image_file/');
	       $this->set('RESUME_PATH', '/files/item_photo/resume_file/');

	       	// set location
	       	$this->set('location',$this->Session->read('location'));
    		$this->location = $this->Session->read('location');

    		// save cookie when site is open first time
    		if ($this->Cookie->read('is_open_fxchng') != 'yes') {
				$this->set('is_open', 'no');
				$this->Cookie->write('is_open_fxchng', 'yes');
    		} else {
    			$this->set('is_open', 'yes');
    		}
	}

	// public function get_location($location = null) {
	// 	pr($location);
	// }
}