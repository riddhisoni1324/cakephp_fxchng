<?php echo $this->start('page-wrapper'); ?>
<?php
echo $this->html->css('validation/titan-ui');
echo $this->Html->script('validation/titan-ui');
?>

<?php //echo $this->element('TabMenu');?>

<div class="fxloginadminarea">

<div class="container">
 <div class="row">
  <div class="col-md-12 col-sm-12 paddnoneleft paddnoneright">
   <div class="loginnewrightarea">
          <div class="fxloginnamberright">
                        <div class="clear"></div>
          </div>
     <div class="fxlogingreayarea">
             <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div>
                          <div class="clear"></div>
                        </div>
                    <h1>Profile<span>update your profile</span></h1><br>
                   </div>
              </div>

        <div>
                              <?php

                              if($activeUser != null){
                                  if(isset($activeUser['User']['fb_birthday']) && isset($activeUser['User']['fb_phone']))
                                  {
                                  $fb_birthday=$user['User']['fb_birthday'];
                                  $fb_phone=$user['User']['fb_phone'];
                                  }

                                  else
                                  {
                                  $fb_birthday='';
                                  $fb_phone='';
                                  }
                            }
                              ?>


         <div class="row">
              <?php

              echo $this->Form->create('Contact', array(
              'type'=>'post',
              'id' => 'profile',
              'data-titan-validate' => "true",
              'name' => 'myForm',
              'url'=>array('controller' => 'dashboard', 'action' => 'profile')));
              ?>
          <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading"><h2>&nbsp;&nbsp;Profile Edit</h2>
               <!--  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="
                       modal"> <i class="fa fa-chevron-down"></i> </a> </div> -->
              </div>
                <div class="panel-body profileform">
                  <div class="flot-medium-container">
                    <div class="formareanew" style="padding:10px;">
                                                 <div class="newpaddbtm10">
                                                        <div class="row">
                                                              <div class="col-md-2">
                                                                <div class="paddtop3">Name <span style="color:red">&nbsp;*</span></div>
                                                              </div>
                                                                <div class="col-md-10">
                                                                       <div class="input-group">
                                                                        <?php
                                                                        echo $this->form->input('fb_name', array( 'class' => 'required form-control', 'div' => false, 'placeholder' => 'First Name', 'label' => false, 'id' => 'first_name', 'READONLY' => 'readonly',  'required','value'=>$user['User']['fb_name']) );
                                                                        ?>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                  </div>


                                                <div class="newpaddbtm10">
                                                  <div class="row">
                                                    <div class="col-md-2">
                                                      <div class="paddtop3">I Am </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                      <div class="input-group">
                                                          <?php

                                                          $name=strtolower($user['User']['fb_gender']);
                                                         if($name=='female')
                                                          {  $g='f'; }
                                                         if($name=='male')
                                                          {
                                                            $g='m';

                                                       }

                                                           $sizes = array('f' => 'female', 'm' => 'male');
                                                        echo $this->Form->input(' ', array('options' => $sizes,
                                                        'default' => $g,'disabled' => true,'type'=>'select'


                                                        ));      ?>


                                                         </div>

                                                      <div class="clear"></div>
                                                     </div>
                                                  </div>
                                                </div>


                                                <div class="newpaddbtm10">
                                                  <div class="row">
                                                    <div class="col-md-2">
                                                      <div class="paddtop3">Birth Date</div>
                                                                        </div>
                                                    <div class="col-md-10">
                                                      <div class="input-group">
                                                                       <?php
                                                                      echo $this->form->input('first_name', array( 'class' => 'required form-control', 'div' => false, 'label' => false, 'id' => 'first_name', 'READONLY' => 'readonly',  'required') );
                                                                      ?>
                                                           </div>
                                                      <div class="clear"></div>
                                                    </div>
                                                  </div>
                                                </div>


                                                <div class="newpaddbtm10">
                                                  <div class="row">
                                                    <div class="col-md-2">
                                                      <div class="paddtop3">Email Address <span style="color:red">&nbsp;*</span></div>
                                                    </div>
                                                    <div class="col-md-10">
                                                      <div class="input-group">
                                                         <?php
                                                                                      echo $this->form->input('username', array( 'class' => 'required form-control', 'placeholder' => 'Email', 'div' => false, 'label' => false, 'id' => 'emailid1','READONLY' => 'readonly','value'=>$user['User']['username'],  'required'));
                                                         ?>
                                                        </div>
                                                      </div>
                                                  </div>
                                                </div>



                                        <div class="newpaddbtm10">
                                          <div class="row">
                                            <div class="col-md-2">
                                              <div class="paddtop3">Phone Number <span style="color:red">&nbsp;*</span></div>
                                            </div>
                                            <div class="col-md-10">
                                              <div class="input-group" style="max-width:300px;">
                                                                      <?php
                                                                      echo $this->form->input('fb_phone', array( 'class' => 'required form-control', 'div' => false, 'label' => false,'maxlength'=>10 ,'id' => 'phno',   'required','value'=>$fb_phone) );
                                                                      ?>
                                              </div>
                                              </div>
                                          </div>
                                        </div>

                                        <div class="newpaddbtm10">
                                          <div class="row">
                                            <div class="col-md-2">
                                              <div class="paddtop3">City <span style="color:red">&nbsp;*</span></div>
                                            </div>
                                            <div class="col-md-10">
                                              <div class="input-group" style="max-width:300px;">
                                            <?php
                                              echo $this->form->input('fb_location', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'city'));
                                            ?>
                                              </div>
                                              </div>
                                          </div>
                                        </div>

                                        <div class="newpaddbtm10">
                                          <div class="row">
                                            <div class="col-md-2">
                                              <div class="paddtop3">Area <span style="color:red">&nbsp;*</span></div>
                                            </div>
                                            <div class="col-md-10">
                                              <div class="input-group" style="max-width:300px;">
                                            <?php
                                              echo $this->form->input('fb_hometown', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'area'));
                                            ?>
                                            </div>
                                              </div>
                                          </div>
                                        </div>


                                          <!-- <div class="newpaddbtm10">
                                            <div class="row">
                                              <div class="col-md-2">
                                                <div class="paddtop3">Describe Yourself</div>
                                              </div>
                                              <div class="col-md-10">
                                                <div class="input-group">
                                                  <?php
                                                        // echo $this->form->input('fb_desc', array( 'class' => 'required form-control', 'div' => false,'type'=>'textarea', 'label' => false, 'id' => 'desc', 'maxlength' => 700,  'cols' => 40, 'rows' => 5, 'required'));
                                                        ?>
                                                </div>
                                                <div class="formspan fntitalic">
                                                </div>
                                              </div>
                                            </div>
                                         </div> -->
                                    <div id="check" style='margin-left:150px;'>
                                    <span >
                                    <?php
                                    echo $this->form->input('mobile_private', array('type' => 'checkbox', 'value' => 1,'id'=>'mobi'));
                                    echo $this->form->input('Email_private', array('type' => 'checkbox', 'value' => 1,'id'=>'mail'));
                                    ?>
                                    </div>
                                  </div>



                                          <div class="newpaddbtm10">
                                            <div class="row">
                                              <div class="col-md-2">
                                              </div>
                                              <div class="col-md-10">
                                                            <?php
                                                      echo $this->form->input('Edit', array('type' => 'submit', 'id'=>'submit_btn', 'class' => 'btn btn-success marright', 'value' => 'submit', 'label' => false, 'div' => false));
                                                      ?>      </div>
                                            </div>
                                          </div>

                    </div>
                  </div>
                </div>
            </div>
          </div>
         </div>
      </div>
    </div>
   </div>
  </div>
 </div>
 </div>
</div>


<script type="text/javascript">
  titanUI.superValidation("#phno", "number-only", 10,10);
/*
   $('#mobi').click(function(e){

        if($('#mobi').prop('checked')) {
        alert('selected');

        } else {
        alert('not selected');
        }

   });
$('#mail').click(function(e){

        if($('#mail').prop('checked')) {
        alert('mail selected');

        } else {
        alert(' mail not selected');
        }

   });
*/

$('#phno').keydown(function(e){

    if (e.shiftKey || e.ctrlKey || e.altKey) {
    e.preventDefault();
    } else {
    var key = e.keyCode;
    if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
    e.preventDefault();
    }
     }

  });



   $('#submit_btn').click(function(e){

       e.preventDefault();
        if(titanUI.checkValidation("#profile","#errors-list")) {
          $('#profile').submit();



            return true;
       }
        return false;
   });



</script>

<?php echo $this->end('page-wrapper'); ?>

