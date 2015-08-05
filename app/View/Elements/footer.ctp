<div class="footer">
  <div class="footerbg">
  	<div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-5">
          <div class="popularcities">
            <h2>Popular Cities
              <? //print_r($_SESSION);?>
            </h2>
            <ul class="split">
             
            </ul>
            <div class="clear"></div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3">
          <div class="socialmedia">
            <h2>Social Media</h2>
            <ul>
              <li><a href="https://www.facebook.com/Fxchng" target='_BLANK'><?php echo $this->Html->image('icon_fb.jpg');?></a></li>
              <li><a href="https://www.twitter.com/Fxchng" target='_BLANK'><?php echo $this->Html->image('icon_twitter.jpg');?></a></li>
              <li><a href="https://plus.google.com/116899937477742855310" target='_BLANK' rel="publisher">
            	<?php echo $this->Html->image('icon_gplus.jpg');?></a></li>
              <li><a href="http://www.pinterest.com/fxchng/" target='_BLANK' rel="publisher">
              	<?php echo $this->Html->image('icon_pinterest.jpg');?></a></li>
            </ul>
            <div class="clear"></div>
            <div class="withlove"> <?php echo $this->Html->image('withlove.png');?> </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4">
          <div class="footerleft">
            <h2>Quick Links</h2>
            <ul class="split">

<!--<a role="menuitem" tabindex="-1" href="">My Shortlist <?php echo $this->Html->image('icons_favorites.png');?></a> -->

              <li><a href="<?php echo $this->base. '/home'; ?>">Home</a><span>|</span></li>
              <li class="lastwith"><?php echo $this->Html->link(
                    'Terms and Conditions',
                    array(
                        'controller' => 'TermsAndConditions',
                        'action' => 'index'                        
                    )
                );?><span>|</span></li>
              <li><?php echo $this->Html->link(
                    'About',
                    array(
                        'controller' => 'About',
                        'action' => 'index'
                        
                    )
                );?><span>|</span></li>
              <li class="lastwith"><?php echo $this->Html->link(
                    'Privacy And Policy',
                    array(
                        'controller' => 'PrivacyAndPolicy',
                        'action' => 'index'
                        
                    )
                );?><span>|</span></li>
              <li><?php echo $this->Html->link(
                    'Feedback',
                    array(
                        'controller' => 'Feedback',
                        'action' => 'index'
                        
                    )
                );?><span>|</span></li>
              <li class="lastwith"><a href="<?php echo $this->base. '/SafetyTips'; ?>" >Safety Tips</a></li>
              <li><?php echo $this->Html->link(
                    'Contact us',
                    array(
                        'controller' => 'ContactUs',
                        'action' => 'index'
                        
                    )
                );?> </li>
              <li class="lastwith"><a href="http://www.fxchng.com/blog" target="_blank">Blog</a><span>|</span></li>
            </ul>
            <div class="clear"></div>
          </div>
        </div>
        <div class="col-md-2 col-sm-12 brdline768">
          <div class="footerlogo"><a href=""><?php echo $this->Html->image('logo_footer.png');?></a></div>
          <div class="footertext">Copyright &copy; <?php echo date('Y'); ?> Fxchng.<br />
            All Rights Reserved</div>
          <div class="footertext1">Copyright &copy; <?php echo date('Y'); ?> Fxchng. All Rights Reserved</div>
        </div>
      </div>
    </div>
    <div id="toTop"> ^ Top</div>
  </div>
</div>