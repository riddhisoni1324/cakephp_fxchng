<?php $this->start('page-wrapper'); ?>

<?php App::uses('CakeTime', 'Utility'); ?>
<div class="bannerdown">
	<div class="bannerup">
	 	<?php echo $this->element('mainNavi'); ?>	
	</div>
</div>
<div class="container">	<br>

	<div class="col-md-3">
		<div class="incntinleft">
			<?php echo $this->element('leftNavi');?>
		</div>
	</div>

	<div class="col-md-9">
		<?php echo $this->element('categoryListAjax'); ?>
	</div> 

</div> <!-- End of container -->

<?php $this->end('page_wrapper'); ?>
