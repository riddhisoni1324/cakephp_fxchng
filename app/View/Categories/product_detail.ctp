<?php $this->start('page-wrapper'); ?>

<?php
    // Fetch infinite_scroll.js
    echo $this->Html->script('infinite_scroll/jquery.infinitescroll');
    echo $this->Html->script('infinite_scroll/infinite');
    echo $this->Html->script('elevate_zoom/jquery.elevatezoom');
?>
<script type="text/javascript">
   $(document).ready(function() {

     $(".zoom_image").elevateZoom({
        gallery:'gallery_01',
        cursor: 'crosshair',
        zoomType: "inner",
        galleryActiveClass: 'active',
        imageCrossfade: true
    });

    $(".zoom_image").bind("click", function(e) {
        var ez = $('.zoom_image').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });
   });
</script>
<div class="bannerdown">
  <div class="">
     <?php echo $this->element('mainNavi'); ?>
  </div>
</div>

<div class="pac-container"></div>

<div class="breadcrumbin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="<?php echo $this->base; ?>">Home</a></li>
                    <li><a href="<?php echo $this->base. '/categories/index/'. $item_details['ItemCategory']['item_type_id']; ?>"><?php echo $item_details['ItemCategory']['item_type_name']; ?></a></li>
                    <li><?php echo $item_details['ItemCategory']['name'];?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- store ad_id and ad_fb_id-->
<?php
    echo $this->Form->input('ad_id', array('type' => 'hidden', 'value' => $item_detail['_id'], 'id' => 'ad_id'));
    echo $this->Form->input('ad_fb_id', array('type' => 'hidden', 'value' => $item_detail['personal_info']['fb_id'], 'id' => 'ad_fb_id'));

    if (isset($item_detail['primary_photo'])) {
            echo $this->Form->input('dir', array('type' => 'hidden', 'value' => $item_detail['primary_photo']['dir'], 'id' => 'dir'));
            echo $this->Form->input('file_name', array('type' => 'hidden', 'value' => $item_detail['primary_photo']['filename'], 'id' => 'file_name'));
    }
    echo $this->Form->input('ad_title', array('type' => 'hidden', 'value' => $item_detail['title'], 'id' => 'ad_title'));
    echo $this->Form->input('ad_desc', array('type' => 'hidden', 'value' => $item_detail['description'], 'id' => 'ad_desc'));
    echo $this->Form->input('ad_email', array('type' => 'hidden', 'value' => $item_detail['personal_info']['email'], 'id' => 'ad_email'));
    echo $this->Form->input('ad_person_name', array('type' => 'hidden', 'value' => $item_detail['personal_info']['name'], 'id' => 'ad_person_name'));
    echo $this->Form->input('receiver_mobile', array('type' => 'hidden', 'value' => $item_detail['personal_info']['mobile'], 'id' => 'receiver_mobile'));
    // pr($item_detail);die();
?>
<!-- end of store ad_id -->

<div class="hmcntin" style="margin-top:0;">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <?php echo $this->element('productDetail'); ?>
                <!-- similar ads -->

                <h3 class="h3bule">Similar Ads</h3>
                <?php echo $this->element('categoryList'); ?>
            </div>
            <div class="col-md-3 col-sm-3">
                <!-- User info box -->
                <div class="user-box right-aside-box">
                    <div class="row" >
                        <div class="col-md-3 " style="display:block; margin-top:8px;padding-left:25px; ">
                            <div  class="mutual-box" style="width:50px;">
                                <?php echo $this->html->image($item_detail['personal_info']['fb_pic']); ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="title"><h4 style="border:0px;"><?php echo $item_detail['personal_info']['name']; ?></h4></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="">

                            <div class=""><h2 style="border:0px; padding-left:15px; color:gray;"><i class="fa fa-phone-square"></i>&nbsp;<?php echo $item_detail['personal_info']['mobile']; ?></h2></div>
                         <!--   <div class="small-desc"><i class="fa fa-envelope"></i> <?php //echo $item_detail['personal_info']['email']; ?></div>-->
                        </div>
                    </div>
                </div>

                <div class="show_msg_rply_n_offer">
                  <?php if ($activeUser) {
                        $fb_id = $activeUser['User']['fb_id'];
                        $add_id = $item_detail['personal_info']['fb_id'];
                        if(isset($activeUser['User']['fb_name'])) {
                          $fb_name = $activeUser['User']['fb_name'];
                        }
                        else{
                          $fb_name = '';
                        }
                        if(isset($activeUser['User']['fb_phone'])) {
                          $fb_phone = $activeUser['User']['fb_phone'];
                        }
                        else{
                          $fb_phone = '';
                        }
                    }
                  ?>
                    <div id="cmn_friend_box">
                         <?php echo $this->element('setCommmonFriendsBox'); ?>
                    </div>

                    <?php if ($activeUser != null && $fb_id != $add_id) { ?>
                     <!-- Make an offer form -->
                    <div class="common-contact right-aside-box no-pad-tp">
                        <!-- form for reply ad -->
                        <?php
                        echo $this->Form->create('ItemCategory', array(
                            'url' => array('controller' => 'categories', 'action' => 'make_an_offer')
                            ));
                        ?>

                            <div style="margin-top:20px;"></div>
                            <div class="with-bg-title">send message</div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-inr"></i></div>

                                    <?php
                                    echo $this->form->input('offer-rs', array( 'class' => 'required form-control', 'div' => false, 'label' => false,'maxlength'=>10 ,'id' => 'offer-rs','placeholder'=>'Offer Price','value'=>$fb_phone) );
                                      ?>


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <?php
                                    echo $this->form->input('offer-mobile', array( 'class' => 'required form-control', 'div' => false, 'label' => false,'maxlength'=>10 ,'id' => 'offer-mobile','placeholder'=>'Contact No ','value'=>$fb_phone) );
                                      ?>

                                </div>
                            </div>
                            <button type="button" class="common-btn" id="submit-ad-offer">
                                offer
                            </button>
                         <!-- end of form for make an end ad -->
                    </div> <!-- end of Make an offer form -->

                    <!-- Contact form -->
                    <div class="common-contact right-aside-box no-pad-tp">
                        <!-- form for reply ad -->
                        <?php
                        echo $this->Form->create('ItemCategory', array(
                            'url' => array('controller' => 'categories', 'action' => 'set_ad_reply')
                            ));
                        ?>

                            <div class="with-org-bg-title">send message</div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>

                                    <?php
                                    echo $this->form->input('fb_name', array( 'class' => 'required form-control', 'div' => false, 'placeholder' => 'First Name', 'label' => false, 'id' => 'sender-name', 'value'=>$fb_name));
                                    ?>
                                 </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <?php
                                          echo $this->form->input('fb_phone', array( 'class' => 'required form-control', 'div' => false, 'label' => false,'maxlength'=>10 ,'id' => 'sender-mobile','placeholder'=>'Contact No ' ,'value'=>$fb_phone) );
                                      ?>

                                    </div>
                            </div>
                            <div class="form-group" style="display:none;">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                          <?php
                                              echo $this->form->input('hidden', array( 'class' => 'required form-control', 'placeholder' => 'Email', 'div' => false, 'label' => false, 'id' => 'sender-email','value'=>$item_detail['personal_info']['email']));
                                           ?>

                                </div>
                            </div>

                            <div class="message-area">
                                <textarea class="form-control" rows="3" placeholder="Type your message here.." id="sender-msg"></textarea>
                            </div>
                            <button type="button" class="common-btn-orange" id="submit-ad-reply">
                                send
                            </button>
                         <!-- end of form for reply ad -->
                    </div> <!-- end of Contact form -->
                    <?php } ?>
                </div>  <!-- end of class="show_msg_rply_n_offer" -->
            </div>

        </div>
    </div>
</div>

 <!-- Modal -->
<div class="modal fade" id = "modal_friends">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send Mail</h4>
            </div>
            <div class="modal-body" style="margin:auto; display:block;">
                <!-- Contact form -->
                <div class="common-contact no-pad-tp"> <!-- removed class="right-aside-box" -->
                    <!-- form for reply ad -->
                    <?php
                    echo $this->Form->create('ItemCategory', array(
                        'url' => array('controller' => 'categories', 'action' => 'set_ad_reply')
                        ));
                    ?>

                        <!-- <div class="with-bg-title">Send Mail</div> -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="">&nbsp; <strong>To</strong> &nbsp; </i></div>
                                <input style="width:100%;" type="text" class="form-control" placeholder="Name" id="common_friend_name" readonly="readonly">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input type="text" class="form-control" placeholder="contact no" id="sender-mobile">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class=""><strong>From</strong></i></div>
                                <input style="width:100%;" type="text" class="form-control" placeholder="email" id="common_friend_email" readonly="readonly">
                            </div>
                        </div>
                        <div class="message-area" style="max-width: 100%;">
                                <textarea class="form-control" rows="3" placeholder="Type your message here.." id="common_friend_msg"></textarea>
                        </div>
                        <button type="button" class="common-btn" id="submit_common_friend">
                            SEND
                        </button>
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    </form> <!-- end of form for reply ad -->
                </div> <!-- end of Contact form -->
            </div>
            <!-- <div class="modal-footer">
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#submit-ad-reply').click(function() {

            // console.log('clicked');
            var name = $('#sender-name').val();
            var mobile = $('#sender-mobile').val();
            var email = $('#sender-email').val();
            var msg = $('#sender-msg').val();
            var tmp_ad_id = $('#ad_id').val();
            var tmp_ad_fb_id = $('#ad_fb_id').val();
            var tmp_dir = $('#dir').val();
            var tmp_file_name = $('#file_name').val();
            var tmp_ad_title = $('#ad_title').val();
            var tmp_ad_desc = $('#ad_desc').val();
            var tmp_ad_email = $('#ad_email').val();
            var tmp_ad_person_name = $('#ad_person_name').val();

            var user_data = {
                senderName: name,
                senderMobile: mobile,
                senderEmail: email,
                senderMsg: msg,
                ad_id : tmp_ad_id,
                ad_fb_id : tmp_ad_fb_id,
                dir: tmp_dir,
                file_name: tmp_file_name,
                ad_title: tmp_ad_title,
                ad_desc: tmp_ad_desc,
                ad_email: tmp_ad_email,
                ad_person_name: tmp_ad_person_name
            };
            $.ajax({
                type: 'POST',
                data: user_data,
                url : baseUrl+'categories/set_ad_reply',
                success: function(flag) {
                     if (flag == "1") {
                        alert('Message successfully send');
                    } else {
                        alert("Can't able to send send message.");
                    }
                },
                error: function() {
                    alert("Can't able to send send message.");
                }
            });
        });

        $('#submit-ad-offer').click(function() {

            // console.log('clicked');
            var tmp_receiver_mobile = $('#receiver_mobile').val();
            var tmp_sender_mobile = $('#offer-mobile').val();
            var tmp_ad_title = $('#ad_title').val();
            var tmp_offer_rs = $('#offer-rs').val();
            var tmp_ad_id = $('#ad_id').val();
            var tmp_ad_fb_id = $('#ad_fb_id').val();

            var sms_data = {

                ad_title: tmp_ad_title,
                receiver_mobile: tmp_receiver_mobile,
                offer_rs : tmp_offer_rs,
                sender_mobile: tmp_sender_mobile,
                ad_id : tmp_ad_id,
                ad_fb_id : tmp_ad_fb_id
            };
            $.ajax({
                type: 'POST',
                data: sms_data,
                url : baseUrl+'categories/make_an_offer',
                success: function(flag) {
                    if (flag == "1") {
                        alert('SMS send successfully.');
                    } else {
                        alert("Can't able to send send SMS.");
                    }
                },
                error: function() {
                    alert("Can't able to send send SMS.");
                }
            });
        });
        var receiver_email = "";
        // get common friend email and name
        $('.common_friend').click(function() {
            receiver_email = $(this).attr("data-email");
            var name = $(this).attr('title');
            // var mobile = $(this).attr("data-mobile");
            var a = $(this).data("mobile");
            // open modal
            $('#modal_friends').modal('show');
            // get receiver email
            var sender_name = "<?php if($activeUser != null ) { echo $activeUser['User']['fb_name']; } ?>";
            console.log(sender_name);
            // set name and email
            $('#common_friend_name').val(name);
            $('#common_friend_email').val(sender_name);

        });

        $('#submit_common_friend').click(function() {

            var email = receiver_email//$('#ad_email').val();
            var name = $('#common_friend_name').val();
            var tmp_msg = $('#common_friend_msg').val();
            var tmp_ad_title = $('#ad_title').val();
            var tmp_ad_desc = $('#ad_desc').val();
            var tmp_ad_email = $('#ad_email').val();
            var tmp_ad_person_name = $('#ad_person_name').val();
            var json_data = {
                "receiver_email": email,
                "receiver_name": name,
                "message": tmp_msg,
                "ad_title": tmp_ad_title,
                "ad_desc": tmp_ad_desc,
                "ad_email": tmp_ad_email,
                "ad_person_name": tmp_ad_person_name
            }
            $.ajax({
                type: 'POST',
                data:json_data,
                url: baseUrl+'categories/get_help',
                success: function(flag) {
                    if (flag == "1") {
                        alert('Message send successfully');
                        $('#modal_friends').modal('hide');
                    } else {
                        alert("Can't able to send message")
                    }
                }
            });
        });
         // set right_side box
              // $('#set_all_right_side_box').click(function() {
              //     console.log('clicked');
              //     var ad_fb_id = "<?php if (isset($item_detail['personal_info']['fb_id'])) { echo $item_detail['personal_info']['fb_id']; }?>";
              //     console.log(baseUrl+'categories/set_common_friends');
              //     $.ajax({
              //         type: 'GET',
              //         url: baseUrl+'categories/set_common_friends/'+ad_fb_id,
              //         success: function() {
              //             // $('#cmn_friend_box').html(right_boxes);
              //         }
              //     });
              // });
        // validation
        $('#sender-mobile').keydown(function(e) {
            if (e.shiftKey || e.ctrlKey || e.altKey) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
                    e.preventDefault();
                }
            }
        });
    });
</script>

<?php $this->end('page-wrapper'); ?>