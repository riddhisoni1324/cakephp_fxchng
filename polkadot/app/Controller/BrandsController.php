<?php
class BrandsController extends AppController {

	public $name = 'Brands';
	public $uses = array('Brand', 'ItemType', 'ItemCategory');


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

    // Objective : This function displays all the Brands
	public function index() {

		// Get all item types
		$brands = $this -> Brand -> find('all');
		$this -> set('brands', $brands);

		// Set the view variables to controller variable values and layout for the view
		$this -> set('page_title', 'View Item Types');
		$this -> layout = 'base_layout';
	}


    // Objective : This function adds the Brand
	public function add() {

        if ($this -> request -> is('post')) {

            // Get the data from post request
            $brand = $this -> request -> data;

            // Add item type
            if ($this -> Brand -> save($brand)) {

                // Display success message and redirect
                $this->Session->setFlash('New brand added.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'brands', 'action' => 'index'));
            } else {

                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'brands', 'action' => 'index'));
            }

        }

        // Get item types
        $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC'));
        $this -> set('item_types', $itemTypes);

        // Set the view variables to controller variable values and layout for the view
        $this -> set('page_title', 'Add Brand');
        $this -> layout = 'base_layout';
	}

    // Objective : This function saves the edited brand
    public function edit($id=null) {

		// Check whether it is a post request or not
		if ($this -> request -> is('post')) {

            // Get the data from post request
            $brand = $this -> request -> data;

            // Save item category
            if ($this -> Brand -> save($brand)) {

                // Display success message and redirect
                $this->Session->setFlash('Selected brand edited.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'brands', 'action' => 'index'));

            } else {

                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'brands', 'action' => 'index'));
            }

        } else{

            // Check whether ID is null, if yes - redirect to index
            if($id == null){
                $this->Session->setFlash('Please choose a item type.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'brands', 'action' => 'index'));
            }

            // Fetch the item type by id
            $selected = $this->Brand->findById($id);
            $this->set('selected',$selected);

            // Get item types
            $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC'));
            $this -> set('item_types', $itemTypes);

            // Set the view variables to controller variable values and layout for the view
            $this -> set('page_title', 'Edit');
            $this -> layout = 'base_layout';

        }
    }

    /*
    // Objective : This function deletes the brand
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

        // Delete selected item category
        if($this->Brand->delete($id)) {

            // Display success message and redirect
            $this->Session->setFlash('Item type deleted.', 'default', array('class' => 'alert alert-success') , 'success');
            $this -> redirect(array('controller' => 'brands', 'action' => 'index'));
        }
        else {

            // Display failure message and redirect
            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'brands', 'action' => 'index'));
        }

    }

    // call by ajax for get sub categories
    public function get_sub_categories($id = null) {

        $this->layout = 'ajax_layout';

        $categories = $this->ItemCategory->find('list', array('conditions' => array('ItemCategory.item_type_id' => $id), 'fields' => array('ItemCategory.id', 'name'), 'order' => 'ItemCategory.sort_order'));

        $this->set('item_categories', $categories);
    }


}
?>