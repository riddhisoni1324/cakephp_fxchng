<?php
class FeedbackController extends AppController {
  var $helpers = array('Html', 'Js');
    
public function beforeFilter() {

        AppController::beforeFilter();
        
            $this->Auth->allow("index");

            // set datasource

            // Set the overall layout
            $this->layout = 'main';

            // set title
            $title = "feedback";
            $this->set('title_for_layout',$title);
        }

    public function index() {
                             if($this->request->is('post'))
                               {

                                    $data=$this->request->data;
                                    pr($data);

                                  
                                    if($this->Feedback->save($data)) {
                                      $this->Session->setFlash('Successfully Added !','default',array('class' =>'alert alert-success'),'success');
                                      //$this->redirect($this->referer());
                                     }
                                     else {
                                            $this->Session->setFlash('Sorry, an error occurred.', 'default', array('class' => 'alert alert-danger') , 'error');
                                        //    $this->redirect($this->referer());
                                     }

                               }

                  }

  
}
?>