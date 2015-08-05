<div class="header">
<!--  <div class="modal fade" id="basicModal_notuser" tabindex="-1" role="dialog" aria-labelledby="basicModal">
    <div class="modal-dialog" style="width:98%;">

      <div class="landingpagemain">
        <div class="container">

        </div>
      </div>
    </div>
    <div class="landingdiv6"> <?php // echo $this->Html->image('welcome_text6.png' , array('alt' => 'welcome text 5','title' => 'welcome text 6'));?>
    </div>
  </div> -->

  <div class="modal fade" id="invite_modal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Invite your friends</h4>
            </div>
            <div class="modal-body">

              <!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
              <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http%3A%2F%2Ffxchng.com&pubid=ra-557e676d3567cc2f&ct=1&pco=tbxnj-1.0" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
              <a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http%3A%2F%2Ffxchng.com&pubid=ra-557e676d3567cc2f&ct=1&pco=tbxnj-1.0" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
              <a href="https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=http%3A%2F%2Ffxchng.com&pubid=ra-557e676d3567cc2f&ct=1&pco=tbxnj-1.0" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/pinterest.png" border="0" alt="Pinterest"/></a>
              <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http%3A%2F%2Ffxchng.com&pubid=ra-557e676d3567cc2f&ct=1&pco=tbxnj-1.0" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
              <a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=http%3A%2F%2Ffxchng.com&pubid=ra-557e676d3567cc2f&ct=1&pco=tbxnj-1.0" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="LinkedIn"/></a>

              <!-- end addthis plugin -->
              <p>Invite your friends to join fxchng</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="container">
    <div class="row posistionreleted">
      <!-- <div class="col-md-12">
        <input type="button" value="Open" style="display:none;" class="floatright btnopen" id="openbtnshow" onclick="javascript:void(jQuery('#searchmobile').show(),jQuery('#openbtnshow').css('display','none'))" />
      </div> -->

      <div class="col-sm-3">
    <!-- Start City Wise Search -->
        <div class="headerleft">
          <div class="floatleft"><a href="#"><?php echo $this->Html->image('logo.png', array('alt' => 'LOGO', 'url'=>array('controller' => 'home', 'action' => 'index')));?>
          </a></div>
          <div class="clear"></div>
        </div>
      <!-- End City Wise Search  -->
        <div class="clear"></div>
      </div>

      <div class="col-sm-9 posistionreleted">

        <div class="headerright" id="divsearch">

          <!-- start form -->
          <?php echo $this->Form->create(null, array(
            'url' => array('controller' => 'Home', 'action' => 'index'),
            'class' => 'location-inpt'
          )); ?>
          <?php $this->Session->read('location'); ?>
          <?php if($location != null) { ?>
            <input type="text" name="citystate" value="" id="citystate" class="" placeholder="<?php echo $location; ?>" />
          <?php } else { ?>
            <input type="text" name="citystate" value="" id="citystate" class="" placeholder="Enter your Location" />
          <?php } ?>

            <p id='city_region'></p>
            <button type="submit" id="get_location"> <i class="fa fa-map-marker"></i> </button>
            <div class="clear"></div>
          </form> <!-- end form -->

           <div class="btnpostad" style = "padding-left:20px;">
            <a href="<?php echo $this->base. '/ad_posts' ?>" class="post-ad-btn">post free ad</a>
            <!-- <a href=""><?//php echo $this->Html->image('btn_postad.png'); ?> </a> -->
            <!-- <img src="./img/btn_postad.png" onMouseOver="./img/btn_postad_hover.png'" onMouseOut="this.src='./img/btn_postad.png'" alt="" /> -->
          </div>

        <?php if ($activeUser == null) { ?>
          <div class="whyfb"><!-- <a href="" data-toggle="modal" data-target="#myModal"></a> -->
            <a href="#myModal" role="button" class="btn hide_fb" data-toggle="modal">Why Facebook?</a>
          </div>
        <?php } ?>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">X</a>
                <h4 class="modal-title"><?php $this->Html->image('logo_popup.png');?></h4>
              </div>
              <div class="modal-body">
                <h3>Why Facebook?</h3>
                <div class="iconwedo">We Do</div>
                <ul class="arrow marbtm">
                  <li>We make it easy to create a new account</li>
                    <li>We verify your identity</li>
                    <li>We identify your friends and network</li>
                    <li>We care for your privacy</li>
                </ul>
                <div class="iconwedont">We Don't</div>
                <ul class="arrow">
                  <li>We don't Spam you</li>
                    <li>We don't access your private data</li>
                </ul>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>

        <!-- //Post free add to be accomodated for other pages -->

          <div class="logintopmainarea">
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
                          <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php //echo $this->base.'/dashboard/shortlist'; ?>">My Shortlist <?php echo $this->Html->image('icons_favorites.png');?></a></li> -->
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
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>

      </div>
  </div>
</div>
<style type="text/css">
  .ui-menu {
  z-index: 9999 !important;
}
</style>
<script type="text/javascript">
    // get all cities from API for Real Estate
    $(document).ready(function() {
      // set city
      var current_city = '';

      $(document).on('keyup', '#citystate', function() {

        // get current val of city textbox.
        var search = $(this).val().toLowerCase();

        cities_url = baseUrl+"ad_posts/get_cities/"+search;

          $('#citystate').autocomplete({
            source: cities_url,
            delay: false,
            minLength: 3,

            focus: function(event, ui) {
              $('#citystate').val(ui.item.city_name);
              return false;
            },
            select: function(event, ui) {
              $('#citystate').val(ui.item.city_name);
              $('#city_region').val(ui.item.region);
              current_city = ui.item.city_name;
              return false;
            }
          })
          .data("ui-autocomplete")._renderItem = function( ul, item ) {
            return $( "<li>" )
              .append( "<a>" + item.city_name + "-" + item.region + "</a>" )
              .appendTo( ul );
          };
      }); // end of keyup event of id=city

      // Get city
      $('#get_location').click(function(e) {

        if (current_city == '' || current_city == 'undefined' || current_city == null) {

           e.preventDefault();
           alert('Please, select city')
        }
        else {

          url = baseUrl+'home/get_location/'+current_city;
            $.ajax({
            url: url,
            type: 'GET',
            success: function() {
              $('#citystate').val(current_city);
            }
          });
        }
      }); // end of click event
    }); // end of main ready function

</script>