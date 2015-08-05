<div id="common_friend_box"> <!--commmon friends box -->
    <?php if ($activeUser != null) { ?>
        <?php if ($mutual_friend_details != null) { ?>
            <div class="mutual-box with-bg-title right-aside-box no-pad-tp">
                <div class="with-bg-title">
                    mutual friends
                </div>
                <div class="mututal-list-area">
                    <?php foreach ($mutual_friend_details as $friend_details) {
                        if ($friend_details['mutual_friend_pic'] != null) { ?>
                            <div class="row mutual-list">
                                <div class="col-md-4">
                                    <?php  echo $this->html->image($friend_details['mutual_friend_pic']); ?>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="title"><a class = "common_friend" data-email = "<?php echo $friend_details['email']; ?>"><?php echo $friend_details['mutual_friend_name']; ?></a></div>
                                    </div>
                                </div>
                            </div>
                    <?php } } ?>
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
                    <button type="button" class="fb-btn fb_auth">
                        <i class="fa fa-facebook-official"></i>
                        Signup / Login
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div> <!-- End of commmon friend box -->