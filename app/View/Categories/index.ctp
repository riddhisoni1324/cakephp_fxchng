<?php $this->start('page-wrapper'); ?>

<?php App::uses('CakeTime', 'Utility'); ?>

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
                	<li><?php echo $item_type['ItemType']['name']; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="hmcntin" style="margin-top:0;">
	<div class="container">

		<div class="col-md-3">
			<div class="incntinleft">
				<?php echo $this->element('leftNavi');?>
			</div>
		</div>

		<div class="col-md-9">
			<!-- for infinite scroll -->
		 	<div class="navigation">
				<a href="http://localhost/fx_new/categories/index_ajax/<?php echo $id. '/'. $page+1; ?>"></a>
				<?php
					 // pr($this->html->link($this->base.'/categories/index_ajax/'. $id, $page+1));
					echo $this->Form->input('current_item_id', array('type' => 'hidden', 'id' => 'get_current_id', 'value' => $id));
				?>
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

	echo $this->Html->script('search_filter/left_type_filter');
?>

<?php $this->end('page_wrapper'); ?>
