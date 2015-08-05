<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
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

    // Configuration for using auth component
	public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Admin' => array(

                    // Specify the model to authenticate
                    'userModel' => 'Admin',

                    // Specify the fields of the model which are to be used as username and passoword
                    'fields' => array(
                        'username' => 'username',
                        'password' => 'password'
                    )
                )
            )
        )
    );





    /*
    // Objective : This function gets executed before each of the actions of this controller render view
    // Author : Ishan Sheth
    // Last Edit : 24/4/2014
    */
    public function beforeFilter(){

        // Configure the auth component attributes
        $this->Auth->loginRedirect = array('controller' => 'home', 'action' => 'index');
        $this->Auth->logoutRedirect = array('controller' => 'admins', 'action' => 'login');
        $this->Auth->loginAction = array('controller' => 'admins', 'action' => 'login');
		
        // Set logged In user variables
        $this->set('isLoggedIn',$this->Auth->loggedIn());
        $this->set('activeUser',$this->Session->read('Auth'));

        // $this->set('hostedSiteUrl',"https://brewshop.in/dev/items/index/");        

        // Setting the variables
        $this->activeUser = $this->Session->read('Auth');
        $this->isLoggedIn = $this->Auth->loggedIn();
        
        $c_controller = $this->params['controller'];
        $this->Session->write('c_action',$this->action);
        $this->c_controller = $c_controller;
        $this->c_action = $this->Session->read('c_action');
        $this->set('c_controller',$this->c_controller);
        $this->set('c_action',$this->c_action);
        
        // login back to referer url 
        if($this->Session->check('referere_url') == false)
        { 
            if($this->c_action != "logout" && $this->c_action != "login")
            {
                $referere_url = Router::url($this->last, true);
                $this->Session->write('referere_url',$referere_url);
                $this->Session->write('redirect_flag',4); 
            }
        }
        else
        {
            if($this->Session->check('redirect_flag') == true)
            {
                $referere_flag = $this->Session->read('redirect_flag');
                if($referere_flag <=  1)
                {
                    $this->Session->delete('referere_url');
                    $this->Session->delete('redirect_flag');
                }
                else
                {
                    $referere_flag = $referere_flag - 1;
                    $this->Session->write('redirect_flag',$referere_flag);
                }
            }
        }

       
	}
}