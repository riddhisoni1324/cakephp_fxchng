<?php $this->start('page-wrapper'); ?>
<?php
echo $this->html->css('validation/titan-ui'); 
echo $this->Html->script('validation/titan-ui');
?>



   
<div class="bannerdown">
  <div class="">
    <?php echo $this->element('mainNavi'); ?> 
    <div class="container">
      <?php //echo $this->element('homeBanner'); ?>
    </div>
  </div>
</div>

  
<div class="breadcrumbin">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <ul>
                  </ul>
                </div>
            </div>
        </div>
  </div>


<div class="hmcntin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                      <div class="hmcntinright minheight400">
                      <div class="table-responsive marbtm10">
                      <h2>Contact Us</h2>
                      </div>


                      <div class="needhelp">

                              <!--strat of left portion-->
                            <div class="cntleft">
                              <p><strong>Need Help?</strong></p>
                              <p>For site related issues, check out our Help section or email us at <a href="#">support@fxchng.com</a></p>
                             <!--  <p>You can also call our support team @ <strong>000-66666666 (M-F: 10AM to 6PM)</strong></p> -->
                              <br>
                              <p><strong>Work with the big Q!</strong></p>
                              <p>Wanna join the smart folks at fxchng &amp; work for the hottest internet startup in India? Quikly email your resume to <a href="#">careers@fxchng.com</a></p>
                            </div>
                            <!--end of left portion-->



                            <div class="cntright">
                              <h3 class="specalh3 conth3768">Inquiry Form</h3>
                                    <?php

                                    echo $this->Form->create('Contact', array(
                                        'type' => 'post',
                                        
                                            'id' => 'add-form',
                                            'data-titan-validate' => "true",
                                            'name' => 'myForm',
                                            'url'=>array('controller' => 'contactus', 'action' => 'index'))); 
                                    ?>


                                     <div class="cntrightin">
                                          <div>
                                                  <p>First Name<span style="color:red">&nbsp;*</span></p>
                                                  <span class="name">

                                                    <?php
                                                    echo $this->form->input('first_name', array( 'class' => 'required form-control', 'div' => false, 'placeholder' => 'First Name', 'label' => false, 'id' => 'first_name',  'required'));
                                                    ?>
                                                  </span>
                                                  <div class="clear"></div>
                                            </div>


                                            <div>
                                                  <p>Last Name<span style="color:red">&nbsp;*</span></p>
                                                  <span class="name">

                                                    <?php
                                                    echo $this->form->input('last_name', array( 'class' => 'required form-control', 'placeholder' => 'Last Name', 'div' => false, 'label' => false, 'id' => 'last_name',  'required'));
                                                    ?>
                                                  </span>
                                                  <div class="clear"></div>
                                            </div>
       

                                            <div>
                                                  <p>Email<span style="color:red">&nbsp;*</span></p>
                                                  <span class="name">

                                                    <?php
                                                    echo $this->form->input('email', array( 'class' => 'required form-control', 'placeholder' => 'Email', 'div' => false, 'label' => false, 'id' => 'emailid1',  'required'));
                                                    ?>
                                                  </span>
                                                  <div class="clear"></div>
                                            </div>


                                             <div>
                                                  <p>Phone No.<span style="color:red">&nbsp;*</span></p>
                                                  <span class="name">

                                                    <?php
                                                    echo $this->form->input('phone_no', array( 'class' => 'required form-control', 'placeholder' => 'Phone', 'div' => false, 'label' => false, 'id' => 'phno',  'required'));
                                                    ?>
                                                  </span>
                                                  <div class="clear"></div>
                                            </div>



                                           <div>
                                                <p> Why ? </p>
                                                <span class="name">
                                                <?php
                                                echo $this->form->input('why', array( 'class' => 'required form-control', 'div' => false, 'label' => false, 'id' => 'desc', 'maxlength' => 700, 'placeholder' => 'why?', 'cols' => 40, 'rows' => 5, 'required'));
                                                ?>
                                                </span>
                                                <div class="clear"></div>
                                        </div>
                                      <!-- <div class="btnsubmit"><a href="#">Submit</a></div> -->
                                        <div> 
                                          <span class="name">
                                              <?php
                                              echo $this->form->input('Submit', array('type' => 'submit', 'id'=>'submit_btn', 'class' => 'btn btn-success marright', 'value' => 'submit', 'label' => false, 'div' => false));
                                              ?>                   
                                         </span> 
                                        </div>


                                   </div>
                              <!-- end of center right portion in -->
                             </div>
                             <!-- end of center right portion  -->
                            <div class="clear"></div>
                      </div>                               <!-- end of needhelp  -->

                   </div>
            </div>
        </div>
    </div>
 </div>
 <script type="text/javascript">
  titanUI.superValidation("#first_name", "alpha-only", true);
  titanUI.superValidation("#last_name", "alpha-only", true);
titanUI.superValidation("#emailid1", "emailid", true, 3, 50);
  titanUI.superValidation("#phno", "number-only", true, 10, 10);


   $('#submit_btn').click(function(e){
       e.preventDefault();
        if(titanUI.checkValidation("#add-form","#errors-list")) {          
          $('#add-form').submit();                      
            return true;             
       }          
        return false;             
   });
</script>
<?php $this->end('page-wrapper'); ?>

