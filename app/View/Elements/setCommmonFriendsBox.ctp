<?php //echo $this->Html->css('boot/bootstrap.min.css'); ?>
<?php //echo $this->Html->script('boot/bootstrap.min.js', array('inline' => false)); ?>

<script type="text/javascript">

$(document).ready(function(){
    // $('[data-toggle="tooltip"]').tooltip();
});

</script>
<div id="common_friend_box"> <!--commmon friends box -->
    <?php if ($activeUser != null) { ?>
        <?php if ($mutual_friend_details) {
            if ($item_detail['personal_info']['email'] != $activeUser['User']['username']) { ?>
            <div class="mutual-box with-bg-title right-aside-box no-pad-tp">
                <div class="with-org-bg-title ">
                    mutual friends
                </div>
                <!-- /*mututal-list-area*/ -->
                <div class="row mutual-list-common" style="max-height:100px; overflow-y: auto;">
                    <?php foreach ($mutual_friend_details as $friend_details) {
                        // pr($item_detail['personal_info']['email']);

                             if ($friend_details['mutual_friend_pic'] != null) { ?>
                                <div class="col-md-3" style="padding:0 10px 15px 10px;">
                                    <a href="#" class = "common_friend" data-toggle="tooltip" data-placement="top" title="<?php echo $friend_details['mutual_friend_name']; ?>" data-email = "<?php echo $friend_details['email']; ?>">
                                        <?php  echo $this->html->image($friend_details['mutual_friend_pic']); ?>
                                    </a>
                                </div>
                                <!--<div class="col-md-8">
                                    <div class="row">
                                       <div class="title"><a class = "common_friend" data-email = "<?php //echo $friend_details['email']; ?>"><?php/// echo $friend_details['mutual_friend_name']; ?></a></div> -->
                                    <!-- </div>
                                </div>-->
                                <!--<?php// pr($friend_details['mutual_friend_name']);?>-->
                    <?php } } } ?>
                </div>
            </div>
        <?php } else { ?>
            <!-- Invite your friends -->
            <div class="common-fb right-aside-box">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <img src="/fx_new/img/invite-friends.png"> -->
                        <?php echo $this->Html->image('invite-friends.png'); ?>
                        <div class="fb-btn">
                            <button type="button" class="fb-btn">
                                <i class="fa fa-facebook-official"></i>
                                Invite
                            </button>
                        </div>
                    </div>
                </div>
            </div> <!--end of Invite your friends -->
        <?php } ?>
   <?php } else { ?>
    <!-- Connect with facebook -->
    <div class="common-fb right-aside-box">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Html->image('connect-with-fb.png'); ?>
                <div class="fb-btn">
                    <button type="button" class="fb-btn fb_auth" id="set_all_right_side_box">
                        <i class="fa fa-facebook-official"></i>
                        Signup / Login
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div> <!-- End of commmon friend box -->