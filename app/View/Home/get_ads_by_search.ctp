<?php $this->start('page-wrapper'); ?>

<?php App::uses('CakeTime', 'Utility'); ?>
<?php echo $this->Form->input('search', array('type' => 'hidden' ,'id' => 'search', 'value' => $search)); ?>
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
                    <li><?php echo 'Search'; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="hmcntin" style="margin-top:0;">
    <div class="container">

        <div class="col-md-3">
            <div class="incntinleft">
                <?php echo $this->element('home_left_navi');?>
            </div>
        </div>

        <div class="col-md-9">
            <h3 style="margin-top:0;">Search result for <strong><span style="color:black;">"<?php echo $search;?>"</span></strong></h3>
            <div class="hmcntinright2">
                <div class = "dynamic_fiburcation">
                <div class="row">
                    <div class="col-md-9 col-sm-9">

                            <?php foreach ($fiburcation as $key => $value) { ?>

                                <div class="accordion" id="accordion2">
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne<?php echo $key; ?>">
                                                <?php echo $value['name']. ' ('. $value['total']. ')'; ?>
                                          </a>
                                        </div>
                                        <div id="collapseOne<?php echo $key; ?>" class="accordion-body collapse">
                                          <div class="accordion-inner">
                                            <?php //echo $this->Html->link($value['cat']['name']. ' ('. $value['cat']['total']. ')', array('controller' => 'home', 'action' => 'get_ads_by_search', $search, $value['cat']['id'])); ?>
                                            <?php //echo $this->Html->link($value['cat']['name']. ' ('. $value['cat']['total']. ')'); ?>
                                            <a href="" class="search_cat" data-value="<?php echo $value['cat']['id']; ?>"><?php echo $value['cat']['name']. ' ('. $value['cat']['total']. ')'; ?></a>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                    </div>
                </div>
            </div>
            </div>


            <div class="dynamic_filter_content">
                <?php echo $this->element('categoryList'); ?>
            </div>
        </div>
    </div> <!-- End of container -->
</div> <!-- end of class = "hmcntin" -->

<?php

    // Fetch infinite_scroll.js
    echo $this->Html->script('infinite_scroll/jquery.infinitescroll');
    echo $this->Html->script('infinite_scroll/infinite');
?>

<?php

    echo $this->Html->script('search_filter/filter_home');
?>

<?php $this->end('page_wrapper'); ?>
