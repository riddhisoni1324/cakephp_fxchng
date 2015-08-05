<?php echo $this->start('page-wrapper'); ?>
<?php echo $this->Form->input('ad_fb_id', array('type' => 'hidden', 'id' => 'ad_fb_id', 'value' => $fb_id)); ?>
<div class="hmcntin">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-9">
        <ul class="nav nav-tabs nav-justified utilities-navs" role="tablist">
          <li role="presentation" class="active">
          <?php if (isset($total_ads)) { ?>
            <a href="#active" aria-controls="active" role="tab" data-toggle="tab" id="tab_active_ad">Active <label id="total_ads"><?php echo $total_ads; ?></label></a>
          <?php } else { ?>
            <a href="#active" aria-controls="active" role="tab" data-toggle="tab" id="tab_active_ad">Active <label id="total_ads">0</label></a>
          <?php } ?>
          </li>
          <li role="presentation" class="">
            <a href="#completed" aria-controls="completed" role="tab" data-toggle="tab" id="tab_completed_ad">Completed <label>0</label></a>
          </li>
          <li role="presentation" class="">
            <a href="#expired" aria-controls="expired" role="tab" data-toggle="tab" id="tab_expired_ad">Expired <label>0</label></a>
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="active ">
            <div class="my_ad_data">
              <?php echo $this->element('myAdList');?>
            </div>
          </div>
          <!-- <div role="tabpanel" class="tab-pane" id="completed">
            <?php //echo $this->element('myAdList');?>
            <div class="hmcntin"><center>No More Completed ads.</center></div>
          </div>
          <div role="tabpanel" class="tab-pane" id="expired">

            <div class="hmcntin"><center>No More Expired ads.</center></div>
          </div> -->
        </div>

      </div>
      <!-- <div class="col-md-3 col-sm-3">

        <div class="common-contact right-aside-box no-pad-tp">
          <form>
              <div class="with-bg-title">alert box</div>

              <div class="user-box alert-box">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="avatar-img"><i class="fa fa-user"></i></div>
                        </div>
                        <div class="col-md-8 no-pad-lt">
                            <div class="title">Alister H Clinton</div>
                            <div class="small-desc"><i class="fa fa-phone-square"></i> +91 94485 55471</div>
                            <div class="small-desc"><i class="fa fa-envelope"></i> aliseterh@gmail.com</div>
                        </div>
                    </div>
                </div>

              <div class="message-area">
                  <label>Message</label>
                  <textarea class="form-control" rows="3" placeholder="Type your message here.."></textarea>
              </div>
              <div class="message-area">
                  <label>Reply</label>
                  <textarea class="form-control" rows="3" placeholder="Type your message here.."></textarea>
              </div>
              <button type="button" class="common-btn">
                  submit
              </button>
          </form>
        </div>

      </div> -->
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    // store requested fb_id
    var fb_id = $('#ad_fb_id').val();

    $('#tab_active_ad').click(function () {

      url_get_active_ad = baseUrl+'dashboard/get_active_ads/'+fb_id;
      $.ajax({
        type: 'POST',
        url: url_get_active_ad,
        success: function(active_ads) {
          $('.my_ad_data').html(active_ads);
        }
      });
    });

    $('#tab_completed_ad').click(function () {

      url_get_completed_ad = baseUrl+'dashboard/get_completed_ads/'+fb_id;
      $.ajax({
        type: 'POST',
        url: url_get_completed_ad,
        success: function(active_ads) {

          $('.my_ad_data').html(active_ads);
        }
      });
    });

    $('#tab_expired_ad').click(function () {
      url_get_expired_ad = baseUrl+'dashboard/get_expired_ads/'+fb_id;
      $.ajax({
        type: 'POST',
        url: url_get_expired_ad,
        success: function(active_ads) {

          $('.my_ad_data').html(active_ads);
        }
      });
    });
  })
</script>

<?php echo $this->end('page-wrapper'); ?>
