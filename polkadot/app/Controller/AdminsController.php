<?php
class AdminsController extends AppController {





    /*
    // Objective : This function gets executed before each of the actions of this controller render view
    // Author : Ishan Sheth
    // Last Edit : 24/4/2014
    */
	public function beforeFilter()
    {
        AppController::beforeFilter();

        // Basic setup
        $this->Auth->authenticate = array('Form');
		
        // Pass settings in
        $this->Auth->authenticate = array(
            'Form' => array('userModel' => 'Admin')
        );
        $this->Auth->allow('login');
		
		//$this->Auth->authorize = 'Controller';
	    //parent::isAuthorized();
    }





	public $name = 'Admins';
	var $uses = array('Admin','AdminType');





    /*
    // Objective : This function logs out the admin
    // Author : Ishan Sheth
    // Last Edit : 24/4/2014
    */
    public function logout(){

        // Logout using auth component
        if($this->Auth->logout()) {

            // Display success message and redirect
			$this->Session->setFlash('Successfully logged out !','default',array('class' =>'alert alert-success'),'good');
            $this->redirect(array('controller'=>'admins','action'=>'login'));
        } else {

            // Display failure message and redirect
            $this->redirect(array('controller'=>'admins','action'=>'login'));
        }
    }





    /*
    // Objective : This function is used to log the admin into the system
    // Author : Ishan Sheth
    // Last Edit : 29/7/2014
    */
    public function login(){

        // Set the layout
        $this->layout = "login_layout";	   

        // Check whether login request is a post request or not
        if($this->request->is('post')){

            // Login admin using auth component, if it is a valid post request
            if($this->Auth->login()) {
				
                if($this->Session->check('referere_url') == true)
		{
			$referere_url = $this->Session->read('referere_url');
			if($referere_url != null && $referere_url != "")
			{
				$this->Session->delete('referere_url');
				$this->Session->delete('redirect_flag');
				$this->redirect($referere_url);
			}
			else
			{
				$this->Session->delete('referere_url');
				$this->Session->delete('redirect_flag');
				// pr("test111");die();
				$this->redirect(array('controller'=>'Home','action'=>'index'));
			}
		}
		else
		{	
			$this->Session->delete('referere_url');
			$this->Session->delete('redirect_flag');
			// pr("test222");die();
			$this->redirect(array('controller'=>'Home','action'=>'index'));
		}
            } else {
            	
                // Display failure message and redirect
				$this->Session->setFlash('Invalid Username or Password','default',array('class' =>'alert alert-danger'),'bad');
				$this->redirect(array('controller'=>'admins','action'=>'login'));
            }
        }
    }





    /*
    // Objective : This function is used to facilitate change password for admins
    // Author : Ishan Sheth
    // Last Edit : 13/8/2014
    */
    public function change_password()
    {
        if($this->request->is('post'))
        {
            $old_pass = AuthComponent::password($this->data['Admin']['old_password']);
            $check_exist = $this->Admin->findByPassword($old_pass);
            if($check_exist)
            {

               

                $update_new_pass = array();
                $update_new_pass['Admin']['id'] = $this->activeUser['User']['id'];
                $update_new_pass['Admin']['password'] = $this->data['Admin']['new_password'];
                if($this->Admin->save($update_new_pass))
                {
                    // Display success message and redirect
                    $this->Session->setFlash('Password changed successfully.', 'default', array('class' => 'alert alert-success') , 'success');
                    $this -> redirect(array('controller' => 'home', 'action' => 'index'));
                }
                else
                {
                    // Display failure message and redirect
                    $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                    $this -> redirect(array('controller' => 'admins', 'action' => 'change_password'));
                }

            }
            else
            {
                // Display failure message and redirect
                $this->Session->setFlash('Invalid current password.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'admins', 'action' => 'change_password'));
            }
        }

        // Set the view variables to controller variable values and layout for the view     
        $this -> set('page_title', 'Change Password');        
        $this->layout = "base_layout";
    }





    /*
    // Objective : This function displays all the admins
    // Author : Ishan Sheth
    // Last Edit : 12/8/2014
    */      
    public function view_admins() {
        
        // we prepare our query, the cakephp way!
        $this->paginate = array(
            'limit' => 10,
            'order' => array('Admin.modified' => 'desc')
        );
     
        // we are using the 'Admin' model
        $users = $this->paginate('Admin');

        // Set the view variables to controller variable values and layout for the view     
        $this -> set('users', $users);
        $this -> set('page_title', 'View Admins');
        $this -> layout = 'base_layout';        
    
    }





    /*
    // Objective : This function adds registered franchise user
    // Author : Ishan Sheth
    // Last Edit : 12/8/2014
    */
    public function add_admin() {

        // Check whether the request is a post request
        if ($this -> request -> is('post')) {

            // Get the data from post request 
            $admin = $this -> request -> data;

            // Add admin
            if ($this -> Admin -> save($admin)) {      

                // Display success message and redirect
                $this->Session->setFlash('New admin added.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'admins', 'action' => 'view_admins'));
            } else {

                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'admins', 'action' => 'view_admins'));
            }

        } 

        // Get admin types
        $adminTypes = $this -> AdminType -> find('list', array('order' => 'AdminType.name ASC'));
        $this -> set('admin_types', $adminTypes);

        // Set the view variables to controller variable values and layout for the view 
        $this -> set('page_title', 'Add Admin');
        $this -> layout = 'base_layout';
    }





    /*
    // Objective : This function deletes the selected admin
    // Author : Ishan Sheth
    // Last Edit : 13/8/2014
    */
    public function delete($id=null) {

        // Check whether ID is null, if yes - redirect to index
        if($id == null) {

            // Display failure message and redirect
            $this->Session->setFlash('Please choose an Admin.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'Admins', 'action' => 'view_admins'));
        }

        // Fetch the item Admin by id
        $selectedAdmin = $this->Admin->findById($id);

        // Check whether ID is null, if yes - redirect to index
        if($selectedAdmin == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose an Admin.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'Admins', 'action' => 'view_admins'));
        }

        // Delete selected Admin
        if($this->Admin->delete($selectedAdmin['Admin']['id'])){

            // Display success message and redirect
            $this->Session->setFlash('Admin deleted.', 'default', array('class' => 'alert alert-success') , 'success');
            $this -> redirect(array('controller' => 'Admins', 'action' => 'view_admins'));

        } else {

            // Display failure message and redirect
            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'Admins', 'action' => 'view_admins'));

        }

    }            
	
}
?>