<?php echo $this->start('page-wrapper'); ?>

<?php if($activeUser != null){ ?>
  <ul class="topfacebookbtn">

    <li>
      <div class="smallloginpersnarea">
        <div class="dropdown login_utilities">
          <div class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
            <div class="floatleft">
              <div class="fxloginbgsmall"> <?php echo $this->Html->image('small_loginperson_bg.png', array('alt' => 'Login'));?></div>
              <div class="fxloginpersonsmall">
              <?php if($activeUser != null){ ?>
                   <img src="<?php echo $activeUser['User']['fb_profilepic']?>" width="42" height="42" />
               <?php }
                else{
                  echo $this->Html->image('imgsmall__login_person.jpg', array('alt' => 'Login'));
                 } ?>
              </div>
            </div>
            <div class="smallpername">
              <div class="login_name">
                <?php if(isset($activeUser['User']['fb_name'])){ echo $activeUser['User']['fb_name']; }?>
              </div>
              <span class="caret"></span>
            </div>
            <div class="clear"></div>
          </div>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation icondashboard"><a role="menuitem" tabindex="-1" href="<?php echo $this->base.'/dashboard'; ?>">Dashboard  <?php echo $this->Html->image('dashboard_icon.png');?></a></li>
        <!--     <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php // echo $this->base.'/dashboard'; ?>">My Alerts
              <?php //echo $this->Html->image('inbox_icon.png');?> </a></li> -->
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $this->base.'/dashboard/my_ads/'. $activeUser['User']['fb_id']; ?>">My Ads
              <?php echo $this->Html->image('your_listing_icon.png');?></a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $this->base.'/dashboard/shortlist'; ?>">My Shortlist <?php echo $this->Html->image('icons_favorites.png');?></a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $this->base.'/dashboard/profile'; ?>">Profile <?php echo $this->Html->image('profile_icon.png');?></a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">Log Out <?php echo $this->Html->image('icons_logout.png');?></a></li>
          </ul>
        </div>
      </div>
    </li>
  </ul>
<?php }
else{
  echo $this->Html->image('fb.jpg', array('id' => 'fb_login','style'=>array("cursor : pointer"), 'class' => 'fb_auth'));
} ?>
<div class="clear"></div>

<?php echo $this->end('page-wrapper'); ?>