<?php
class ItemTypesController extends AppController {

	public $name = 'ItemTypes';
	public $uses = array('ItemType');


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

    
    /*
    // Objective : This function displays all the item types
    // Author : Ishan Sheth
    // Last Edit : 4/8/2014
    */
	public function index() {

		// Get all item types
		$itemTypes = $this -> ItemType -> find('all');
		$this -> set('item_types', $itemTypes);

		// Set the view variables to controller variable values and layout for the view
		$this -> set('page_title', 'View Item Types');
		$this -> layout = 'base_layout';
	}




    
    /*
    // Objective : This function adds the item type
    // Author : Ishan Sheth
    // Last Edit : 4/8/2014
    */
	public function add() {		

        if ($this -> request -> is('post')) {

            // Get the data from post request
            $itemType = $this -> request -> data;
          
            // Set null values to null allowed columns           
            if($itemType['ItemType']['type_id'] == "") {
                $itemType['ItemType']['type_id'] = null;
            }

            // Add item type
            if ($this -> ItemType -> save($itemType)) {
                
                // Display success message and redirect
                $this->Session->setFlash('New item type added.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
            }

        } else {

            // Get item types
            $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC'));
            $this -> set('item_types', $itemTypes);
        }

        // Set the view variables to controller variable values and layout for the view
        $this -> set('page_title', 'Add Item Type');
        $this -> layout = 'base_layout';        
	}




    
    /*
    // Objective : This function saves the edited item type
    // Author : Ishan Sheth
    // Last Edit : 4/8/2014
    */
    public function edit($id=null) {

		// Check whether it is a post request or not
		if ($this -> request -> is('post')) {

            // Get the data from post request
            $itemType = $this -> request -> data;

            // Set null values to null allowed columns
          
            if($itemType['ItemType']['type_id'] == ""){
                $itemType['ItemType']['type_id'] = null;
            }

            // Save item category
            if ($this -> ItemType -> save($itemType)) {

                // Display success message and redirect
                $this->Session->setFlash('Selected item type edited.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
            
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
            }

        } else{

            // Check whether ID is null, if yes - redirect to index
            if($id == null){
                $this->Session->setFlash('Please choose a category.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
            }

            // Fetch the item category by id
            $selectedCat = $this->ItemType->findById($id);
            $this->set('selectedCat',$selectedCat);
            // Get item types
            $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC'));
            $this -> set('item_types', $itemTypes);

            // Get item parent categories
            $itemCatParents = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC','conditions'=>array('not'=>array('ItemType.id'=>$selectedCat['ItemType']['id']))));
            $this -> set('item_category_parents', $itemCatParents);

            // Set the view variables to controller variable values and layout for the view
            $this -> set('page_title', 'Edit Category');
            $this -> layout = 'base_layout';

        }
    }




    
    /*
    // Objective : This function deletes the selected item type
    // Author : Ishan Sheth
    // Last Edit : 28/4/2014
    */
    public function delete($id=null) {

        // Check whether ID is null, if yes - redirect to index
        if($id == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose an item type.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
        }

        // Fetch the item category by id
        $selectedItemType = $this -> ItemType -> findById($id);

        // Check whether ID is null, if yes - redirect to index
        if($selectedItemType == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose an item type.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
        }

        // Delete selected item category
        if($this->ItemType->delete($selectedItemType['ItemType']['id'])){

            // Display success message and redirect
            $this->Session->setFlash('Item type deleted.', 'default', array('class' => 'alert alert-success') , 'success');
            $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
        }
        else{

            // Display failure message and redirect
            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'item_types', 'action' => 'index'));
        }

    }    	

}
?>