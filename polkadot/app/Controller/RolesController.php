<?php
class RolesController extends AppController {

	public $name = 'Roles';
	public $uses = array('Role', 'ItemType');


    public function beforeFilter()
       {
           AppController::beforeFilter();

           // Basic setup
           $this->Auth->authenticate = array('Form');

           // Pass settings in
           $this->Auth->authenticate = array(
               'Form' => array('userModel' => 'User')
           );

           // Check user login session
           if(sizeof($this->activeUser) <= 0)
           {
               $this->Session->setFlash('Sorry! The login session expires, Please check and try again','default',array('class' =>'alert alert-danger'),'bad');
               $this->redirect(array('controller'=>'admins','action'=>'logout'));
           }
       }
    
    // Objective : This function displays all the Roles   
	public function index() {

		// Get all item types
		$roles = $this -> Role -> find('all');
		$this -> set('roles', $roles);

		// Set the view variables to controller variable values and layout for the view
		$this -> set('page_title', 'View Item Types');
		$this -> layout = 'base_layout';
	}
    
 
    // Objective : This function adds the Role
	public function add() {		

        if ($this -> request -> is('post')) {

            // Get the data from post request
            $role = $this -> request -> data;

            // Add item type
            if ($this -> Role -> save($role)) {
                
                // Display success message and redirect
                $this->Session->setFlash('New role added.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
            }

        } 

        // Get item types - only Jobs
        $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC', 'conditions' => array('ItemType.id' => '5568353e-8100-4254-936e-2cb0bf642048')));
        $this -> set('item_types', $itemTypes);

        // Set the view variables to controller variable values and layout for the view
        $this -> set('page_title', 'Add Role');
        $this -> layout = 'base_layout';        
	}   
  
    // Objective : This function saves the edited role  
    public function edit($id=null) {

		// Check whether it is a post request or not
		if ($this -> request -> is('post')) {

            // Get the data from post request
            $role = $this -> request -> data;           

            // Save item category
            if ($this -> Role -> save($role)) {

                // Display success message and redirect
                $this->Session->setFlash('Selected role edited.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
            
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
            }

        } else{

            // Check whether ID is null, if yes - redirect to index
            if($id == null){
                $this->Session->setFlash('Please choose a item type.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
            }

            // Fetch the item type by id
            $selected = $this->Role->findById($id);
            $this->set('selected',$selected);

            // Get item types - only Jobs
            $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC', 'conditions' => array('ItemType.id' => '5568353e-8100-4254-936e-2cb0bf642048')));
            $this -> set('item_types', $itemTypes);

            // Set the view variables to controller variable values and layout for the view
            $this -> set('page_title', 'Edit');
            $this -> layout = 'base_layout';

        }
    }
    
    
    // Objective : This function deletes the selected role
    public function delete($id=null) {

        // Check whether ID is null, if yes - redirect to index
        if($id == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose role.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
        }

        // Delete selected role
        if($this->Role->delete($id)) {

            // Display success message and redirect
            $this->Session->setFlash('Item type deleted.', 'default', array('class' => 'alert alert-success') , 'success');
            $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
        }
        else {

            // Display failure message and redirect
            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'roles', 'action' => 'index'));
        }

    }    	

}
?>