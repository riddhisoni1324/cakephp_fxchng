<?php
class TermsAndConditionsController extends AppController {
  
    
public function beforeFilter() {

        AppController::beforeFilter();
        
            $this->Auth->allow("index");

            // set datasource

            // Set the overall layout
            $this->layout = 'main';

            // set title
            $title = "Terms & Conditions";
            $this->set('title_for_layout',$title);
        }

    public function index() {

       
    }

  
}
?>