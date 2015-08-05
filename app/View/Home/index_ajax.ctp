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

<div class="hmcntin">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="hmcntinleft">
                    <ul>
                        <li class="active"><a href="javascript://" onclick="mproduct()">Popular</a></li>
                        <li><a class="" data-toggle="modal" data-target="#basicModal_con">City</a></li>
                        <li><a class="" data-toggle="modal" data-target="#basicModal_con">Shortlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9">
                <h3 id="tranding" class="margintop11">What is Trending </h3>
                	<?php echo $this->element('categoryListAjax'); ?>
            </div>
        </div>
    </div>
</div>
<?php
    // Fetch infinite_scroll.js
    echo $this->Html->script('infinite_scroll/jquery.infinitescroll');
    // echo $this->Html->script('infinite_scroll/infinite');
?>
<?php $this->end('page-wrapper'); ?>