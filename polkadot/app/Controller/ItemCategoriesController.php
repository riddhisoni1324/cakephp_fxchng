<?php
class ItemCategoriesController extends AppController {

	public $name = 'ItemCategories';
	public $uses = array('ItemCategory', 'ItemType','City');


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
    // Objective : This function displays all the item categories
    // Author : Ishan Sheth
    // Last Edit : 4/8/2014
    */      
	public function index() {

        // Find all item categories
		$itemCats = $this -> ItemCategory -> find('all');
		$this -> set('item_categories', $itemCats);

        // Set the view variables to controller variable values and layout for the view
		$this -> set('page_title', 'Item Categories');
		$this -> layout = 'base_layout';

	}




    
    /*
    // Objective : This function adds the item category
    // Author : Ishan Sheth
    // Last Edit : 4/8/2014
    */    
	public function add() {

        // Set the view variables to controller variable values and layout for the view
        $this -> set('page_title', 'Add Item Category');
        $this -> layout = 'base_layout';

        // Check whether it is a post request or not
		if ($this -> request -> is('post')) {

            // Get the data from post request
			$itemCategory = $this -> request -> data;
          
            // Set null values to null allowed columns
            if($itemCategory['ItemCategory']['item_category_id'] == "") {
                $itemCategory['ItemCategory']['item_category_id'] = null;
            }
            if($itemCategory['ItemCategory']['item_type_id'] == "") {
                $itemCategory['ItemCategory']['item_type_id'] = null;
            }

            // Add item category
            if ($this -> ItemCategory -> save($itemCategory)) {
                
                // Display success message and redirect
				$this->Session->setFlash('New item category added.', 'default', array('class' => 'alert alert-success') , 'success');
				$this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
                // $this->referer();
			} else {
				
                // Display failure message and redirect
				$this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
				$this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
			}

		}
        // Get item types
        $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC'));
        $this -> set('item_types', $itemTypes);

        // Get item parent categories
        $itemCatParents = $this -> ItemCategory -> find('list', array('order' => 'ItemCategory.name ASC'));
        $this -> set('item_category_parents', $itemCatParents);          
		
	}




    
    /*
    // Objective : This function saves the edited item category
    // Author : Ishan Sheth
    // Last Edit : 4/8/2014
    */
    public function edit($id=null) {

        // Check whether it is a post request or not
        if ($this -> request -> is('post')) {

            // Get the data from post request
            $itemCategory = $this -> request -> data;

            // Set null values to null allowed columns
            if($itemCategory['ItemCategory']['item_category_id'] == ""){
                $itemCategory['ItemCategory']['item_category_id'] = null;
            }
            if($itemCategory['ItemCategory']['item_type_id'] == ""){
                $itemCategory['ItemCategory']['item_type_id'] = null;
            }

            // Save item category
            if ($this -> ItemCategory -> save($itemCategory)) {

                // Display success message and redirect
                $this->Session->setFlash('Selected category edited.', 'default', array('class' => 'alert alert-success') , 'success');
                $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
            
            } else {
                
                // Display failure message and redirect
                $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
            }

        } else{

            // Check whether ID is null, if yes - redirect to index
            if($id == null){
                $this->Session->setFlash('Please choose a category.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
            }

            // Fetch the item category by id
            $selectedCat = $this->ItemCategory->findById($id);

            // Check whether resultset is null, if yes - redirect to index
            if($selectedCat == null){
                $this->Session->setFlash('Please choose a category.', 'default', array('class' => 'alert alert-danger') , 'error');
                $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
            }
            $this->set('selectedCat',$selectedCat);

            // Get item types
            $itemTypes = $this -> ItemType -> find('list', array('order' => 'ItemType.name ASC'));
            $this -> set('item_types', $itemTypes);

            // Get item parent categories
            $itemCatParents = $this -> ItemCategory -> find('list', array('order' => 'ItemCategory.name ASC','conditions'=>array('not'=>array('ItemCategory.id'=>$selectedCat['ItemCategory']['id']))));
            $this -> set('item_category_parents', $itemCatParents);

            // Set the view variables to controller variable values and layout for the view
            $this -> set('page_title', 'Edit Category');
            $this -> layout = 'base_layout';

        }
    }




    
    /*
    // Objective : This function deletes the selected item category
    // Author : Ishan Sheth
    // Last Edit : 22/4/2014
    */
    public function delete($id=null) {

        // Check whether ID is null, if yes - redirect to index
        if($id == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose a category.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
        }

        // Fetch the item category by id
        $selectedItemCategory = $this -> ItemCategory -> findById($id);

        // Check whether ID is null, if yes - redirect to index
        if($selectedItemCategory == null){

            // Display failure message and redirect
            $this->Session->setFlash('Please choose a category.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
        }

        // Delete selected item category
        if($this->ItemCategory->delete($selectedItemCategory['ItemCategory']['id'])){

            // Display success message and redirect
            $this->Session->setFlash('Category deleted.', 'default', array('class' => 'alert alert-success') , 'success');
            $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
        }
        else{

            // Display failure message and redirect
            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
            $this -> redirect(array('controller' => 'item_categories', 'action' => 'index'));
        }

    }





}
?>