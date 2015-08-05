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
     <style>
 .highlight{color:red;}
 </style>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="hmcntinright minheight400">
        <div class="table-responsive marbtm10">
          <h2>Feedback</h2>

          <div class="feedbackarea"><div class="cntfeedback">
           
                               <?php

                                echo $this->Form->create('Feedback', array(
                                    'type' => 'post',
                       
                                        'id' => 'feedbackfrm',
                                        'data-titan-validate' => "true",
                                        'name' => 'myForm',
                                        'url'=>array('controller' => 'feedback', 'action' => 'index'))); 
                                ?>
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
                                                    echo $this->form->input('email', array( 'class' => 'required form-control', 'placeholder' => 'Email', 'div' => false, 'label' => false, 'id' => 'mail',  'required'));
                                                    ?>
                                                  </span>
                                                  <div class="clear"></div>
                                            </div>

                                           <div>
                                              <p>Your Comments<span style="color:red">&nbsp;*</span></p>
                                                <span class="name">
                                                <?php
                                                echo $this->form->input('comment', array( 'class' => 'required form-control', 'div' => false, 'label' => false, 'id' => 'desc', 'maxlength' => 700, 'placeholder' => 'Your Comments', 'cols' => 40, 'rows' => 5, 'required'));
                                                ?>
                                                </span>
                                                <div class="clear"></div>
                                        </div>

<!--
                                       <div><p> Security Code<span style="color:red">&nbsp;*</p>
                                           &nbsp;&nbsp;<img src="http://fxchng.com/php_captcha.php" class="marbtm" alt="">
                                       </div>


                    <div>
                             <div>
                                <span class="name">
                                                    <?php
                                                    echo $this->form->input('first_name', array( 'class' => 'required form-control captchavalidation', 'div' => false, 'placeholder' => 'Please Enter Here Captcha', 'label' => false, 'id' => 'code',  'required'));
                                                    ?>
                                 <!--<input name="number" class="required captchavalidation" type="text" placeholder="Please Enter Here Captcha" id="number">-->
                                 </span>
                       </div>
                       <div>            
                                  <input type="hidden" name="hidnum" value="613d6e59">
                             
                              <div class="clear"></div>
                            </div>              
                            <div>
                              <span class="name">
                                             <?php
                                              echo $this->form->input('Submit', array('type' => 'submit', 'id'=>'submit_btn', 'class' => 'btn btn-success marright', 'value' => 'submit', 'label' => false, 'div' => false));
                                              ?>                   
                              </span>
                           </div>
                    </div>
                        
              </div>
    <!--end of content filter-->
            </form>
              </div>
            </div>
              <div class="clear"></div>
            </div>


      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  titanUI.superValidation("#first_name", "alpha-only", true);
  titanUI.superValidation("#last_name", "alpha-only", true);
  titanUI.superValidation("#mail", "emailid", true, 3, 50);
  titanUI.superValidation("#desc", "alpha-only", true);
  titanUI.superValidation("#code", "alpha-only", true);


   $('#submit_btn').click(function(e){
       e.preventDefault();
        if(titanUI.checkValidation("#feedbackfrm","#errors-list")) {          
          $('#feedbackfrm').submit();                      
            return true;             
       }          
        return false;             
   });
</script>
<?php $this->end('page-wrapper'); ?>