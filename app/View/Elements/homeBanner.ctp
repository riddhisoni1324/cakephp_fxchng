<div class="row">
  <div class="col-md-12">
    <h1 class="bannertagline">Discover the Power of Your Social Circle.</h1>
    <div class="search" id="divsearch5">

      <!-- <input type="text" name="hsearch" id="hsearch" value="" placeholder="Enter your search here" />
      <input type="button"  id="btnsearch" class="btnsearch"  /> -->
      <!-- <input type="hidden" name="search_keyword" value=''> -->
          <?php echo $this->Form->create(null, array(
            'url' => array('controller' => 'Home', 'action' => 'redirect_to_home')
          )); ?>
          <div class="search-area">
            <input type="text" class="form-control" placeholder="Enter your search here" id = "search_home_text" required name="keyword">
            <button type="submit" id="search_home"> <i class="fa fa-search"></i> </button>
        </div>
      <div class="or"><img src="./img/or.png" alt="" /></div>
      <div class="btnpostad">

        <a href="<?php echo $this->Html->url(array('controller'=>'ad_posts', 'action'=>'index')); ?>" class="post-ad-btn">post free ad</a>

        <!-- <a href=""><?//php echo $this->Html->image('btn_postad.png'); ?> </a> -->


        <!-- <img src="./img/btn_postad.png" onMouseOver="./img/btn_postad_hover.png'" onMouseOut="this.src='./img/btn_postad.png'" alt="" /> -->
      </div>
    </div>
    <div class="fbpage">
      <div align="center">

        <div class="hmbnrcnt">
          <div class="">
              <div class="row pos-r" style="z-index:99;">
                  <div class="col-md-4">
                      <div class="pad10">
                        <img src="./img/search_magnifi-128.png" alt="" />
                        <div class="title">#Find Local Stuff</div>
                        <!-- <p>Find Local stuff in and around your city. Browse through various categories to find used and new stuff. Also post ads for your unwanted items and get discovered by thousands of people from your nearby locality.</p> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="pad10">
                        <img src="./img/groups-13-128.png" alt="" />
                        <div class="title">#Engage Your Friends</div>
                        <!-- <p>We trust our Friends more than anyone. Fxchng allows users to post or browse ads and see details about common friends between buyers and sellers. These friends can help connect potential buyers and sellers.</p> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="pad10">
                        <img src="./img/puppy_medal-128.png" alt="" />
                        <div class="title">#Deal With Confidence</div>
                        <!-- <p>Get help from your friends in finding a trustworthy seller and get further information. You can also be found by a potential buyer for your ad through your friends and complete your most trusted and verified deal.</p> -->
                        </div>
                    </div>
                </div>
                <div class="seprator-hmbnrcnt"></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>