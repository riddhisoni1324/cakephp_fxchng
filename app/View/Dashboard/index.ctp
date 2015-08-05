<?php echo $this->start('page-wrapper'); ?>


<div class="hmcntin">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-9">
        <!-- My Active Ads -->
        <div class="row">
          <div class="col-md-12">
            <h3 id="tranding" class="margintop11">My Active Ads </h3>
          </div>
          <?php if ($activeUser != null) {
            if(sizeof($items) > 0) {
              foreach ($items as $item) {
          ?>
            <div class="col-md-3 col-sm-3">
              <div class="active-ad-col">
                <?php if(isset($item['doc']['primary_photo'])) { ?>
                  <?php echo $this->Html->image($PHOTO_PATH.$item['doc']['primary_photo']['dir'].'/md_'.$item['doc']['primary_photo']['filename'], array('alt' => 'No Image', 'url'=>array('controller'=>'categories', 'action' => 'product_detail', $item['doc']['_id'])));?>
                  <?php } else {
                  echo $this->Html->image('default.jpg', array('alt' => 'No Image', 'class' => 'img-responsive'));
                } ?>
                <div class="active-ad-col-desc">
                  <div class="ad-name"><?php echo $item['doc']['title']; ?></div>
                  <div class="ad-full-desc"><?php echo $item['doc']['description']; ?></div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="row pull-right">
                    <div class="views">
                      <span><label>45</label>views </span>
                    </div>
                    <!-- <button class="edit-ad"><i class="fa fa-pencil"></i></button> -->
                    <a href="<?php //echo $this->base.'/ad_posts/edit_post/'.$item['doc']['_id']; ?>" class="edit-ad"><i class="fa fa-pencil"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php } } } ?>

          <!-- <div class="col-md-4 col-sm-4">
            <div class="active-ad-col">
              <img src="./img/demo-img.jpg" alt="">
              <div class="active-ad-col-desc">
                <div class="ad-name">Macbook Pro 13.3inch (Ratina Display)</div>
                <div class="ad-full-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, et dolore magna aliqua.</div>
              </div>
              <div class="col-md-12 col-sm-12">
                <div class="row pull-right">
                  <div class="views">
                    <span><label>45</label>views </span>
                  </div>
                  <button class="edit-ad"><i class="fa fa-pencil"></i></button>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        <!-- My Alerts -->
        <div class="row">
          <div class="col-md-12">
            <h3 id="tranding" class="margintop11">My Alerts </h3>
          </div>
          <div class="col-md-12">
          <?php if ($activeUser != null) {
            if (sizeof($my_alerts) > 0) {
              foreach ($my_alerts as $my_alert) {
          ?>
             <div class="full-width-row">
              <div class="col-md-3 col-sm-3">
                <!-- <img class="img-responsive" src="./img/demo-img.jpg" alt=""> -->
                <?php if(isset($my_alert['doc']['primary_photo'])) { ?>
                  <?php echo $this->Html->image($PHOTO_PATH.$my_alert['doc']['primary_photo']['dir'].'/sm_'.$item['doc']['primary_photo']['filename'], array('alt' => 'No Image', 'url'=>array('controller'=>'categories', 'action' => 'product_detail', $item['doc']['_id'])));?>
                  <?php } else {
                  echo $this->Html->image('default.jpg', array('alt' => 'No Image', 'class' => 'img-responsive'));
                } ?>
              </div>
              <?php
              // set date
                $created_date = $my_alert['doc']['created'];
                if ($this->Time->isToday($created_date)) {
                  $daycnt= "Today";
                }
                else if ($this->Time->wasYesterday) {
                  $daycnt = "Yesterday";
                }
                else {
                  $daycnt = $this->Time->format('d-m-y', $created_date);
                }
              ?>
              <div class="col-md-9 col-sm-9 no-pad-lt">
                 <p class="alert-desc">Hi, <span><?php echo $my_alert['doc']['name']; ?></span> shown interest in your ad
                  posted on <strong><?php echo $daycnt.' '.date('h:i:s A',strtotime($created_date));?></strong></p>
                  <p class="alert-desc-full">
                    <?php echo $my_alert['doc']['message']; ?>
                  </p>
                  <a href="#" class="view-details-btn"> View Details </a>
              </div>
            </div>
         <?php } } } ?>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <!-- Manage your Shortlist -->
        <div class="shortlist-aside right-aside-box">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-heart"></i>
                    <center>Manage your Shortlist</center>
                </div>
            </div>
        </div>
        <!-- MY NETWORK -->
        <div class="invite right-aside-box no-pad-tp">
          <div class="with-bg-title">My Network</div>
            <center>You are connected to <strong><?php echo $network['count']; ?></strong> people out of <strong><?php echo $network['total']; ?> </strong></center>
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fb-btn">
                  <button type="button" class="fb-btn">  Invite your friends </button>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php echo $this->end('page-wrapper'); ?>
