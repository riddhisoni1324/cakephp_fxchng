<?php $this->start('page-wrapper'); ?>

<div class="bannerdown">
    <div class="bannerup">
        <?php echo $this->element('mainNavi'); ?>
        <div class="container">
            <?php echo $this->element('homeBanner'); ?>
        </div>
    </div>
</div>

<div class="hmcnt">

  <?php echo $this->element('subNavi'); ?>
</div>

<div class="hmcntin" style="margin-top:0;">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="trending_utilities">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h3 id="tranding" class="margintop11" style="border-bottom:0;">What is Trending in <?php echo $location;?></h3>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="" aria-controls="recent" role="tab" data-toggle="tab" id = "recent_tab">Recent</a></li>
                            <li role="presentation"><a href="" aria-controls="home" role="tab" data-toggle="tab" id = "friends_feed_tab">Friends feed</a></li>
                          </ul>
                        </div>
                    </div>
                      <!-- Tab panes -->
                    <div class="tab-content">
                        <br>
                        <div id="home_categories">
                            <?php echo $this->element('categoryList'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <?php echo $this->element('setMutualFriendBox'); ?>
            </div>
        </div>
    </div>
</div>

<?php

    // Fetch infinite_scroll.js
    echo $this->Html->script('infinite_scroll/jquery.infinitescroll');
    echo $this->Html->script('infinite_scroll/infinite');
?>

<script type="text/javascript">
    $(document).ready(function() {
        // get and set friends feed
        $('#friends_feed_tab').click(function() {
            $.ajax({
                type: 'GET',
                url: baseUrl+'home/get_friends_ads',
                success: function(data) {
                    $('#home_categories').html(data);
                    // alert('successfully get');
                }
            });
        });
        // get and set recent ads
        $('#recent_tab').click(function() {
            $.ajax({
                type: 'GET',
                url: baseUrl+'home/get_recent_ads',
                success: function(recent_data) {
                    console.log(recent_data);
                    $('#home_categories').html(recent_data);
                    // alert('successfully get recent data');
                }
            });
        });
        // seacrh ads from home search
        // $('#search_home_text').keyup(function() {
            // $('#search_keyword').val($('#search_home_text').val());
            // $.ajax({
            //     type: 'GET',
            //     url: baseUrl+'home/get_ads_by_search/'+ $('#search_home_text').val(),
            //     success: function(all_data) {
            //         $('#home_categories').html(all_data);
            //         console.log('succeed');
            //     }
            // });
        // });
    });
</script>

<?php $this->end('page-wrapper'); ?>