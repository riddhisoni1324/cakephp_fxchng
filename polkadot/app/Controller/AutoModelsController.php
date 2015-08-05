<?php
class AutoModelsController extends AppController {

	public $name = 'AutoModels';
	public $uses = array('AutoModel', 'Brand');


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
    
    // Objective : This function displays all the Auto_models   
	public function index() {

		// Get all item types
		$auto_models = $this -> AutoModel -> find('all');
		$this -> set('auto_models', $auto_models);

		// Set the view variables to controller variable values and layout for the view
		$this -> set('page_title', 'View Item Types');
		$this -> layout = 'base_layout';
	}
    
 
    // Objective : This function adds the Auto Model
	public function add() {		

        if ($this -> request -> is('post')) {

            // Get the data from post request
            $auto_model = $this -> request -> data;

            // Add item type
            if ($this -> AutoModel -> save($auto_model)) {
                
                // Display success message and redirect
                $this->Session->setFlash('New auto model added.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
            }

        } 

        // Get brands if item_type == 'automonile'
        $brands = $this -> Brand -> find('list', array(
                'order' => 'Brand.name ASC',
                'conditions' => array('Brand.item_type_id' => "55680b42-e360-4882-8274-1b96bf642048")
                ));
        $this -> set('brands', $brands);

        // Set the view variables to controller variable values and layout for the view
        $this -> set('page_title', 'Add AutoModel');
        $this -> layout = 'base_layout';        
	}   
  
    // Objective : This function saves the edited auto_model  
    public function edit($id=null) {

		// Check whether it is a post request or not
		if ($this -> request -> is('post')) {

            // Get the data from post request
            $auto_model = $this -> request -> data;           

            // Save item category
            if ($this -> AutoModel -> save($auto_model)) {

                // Display success message and redirect
                $this->Session->setFlash('Selected auto model edited.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
            
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
            }

        } else{

            // Check whether ID is null, if yes - redirect to index
            if($id == null){
                $this->Session->setFlash('Please choose auto model.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
            }

            // Fetch the auto_model by id
            $selected = $this->AutoModel->findById($id);
            $this->set('selected',$selected);

            // Get brands
            $brands = $this -> Brand -> find('list', array(
                'order' => 'Brand.name ASC',
                'conditions' => array('Brand.item_type_id' => "55680b42-e360-4882-8274-1b96bf642048")
                ));
            $this -> set('brands', $brands);

            // Set the view variables to controller variable values and layout for the view
            $this -> set('page_title', 'Edit');
            $this -> layout = 'base_layout';

        }
    }
    
    
    // Objective : This function deletes the auto model
    public function delete($id=null) {

        // Check whether ID is null, if yes - redirect to index
        if($id == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose role.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
        }

        // Delete selected role
        if($this->AutoModel->delete($id)) {

            // Display success message and redirect
            $this->Session->setFlash('Item type deleted.', 'default', array('class' => 'alert alert-success') , 'success');
            $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
        }
        else {

            // Display failure message and redirect
            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'auto_models', 'action' => 'index'));
        }

    }    	

}
?>