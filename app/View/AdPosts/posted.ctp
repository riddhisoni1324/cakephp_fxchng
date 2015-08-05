<?php $this->start('page-wrapper'); ?>
<div class="bannerdown">
	<div class="">
	 	<?php echo $this->element('mainNavi'); ?>
		<div class="container">
			<?php //echo $this->element('homeBanner'); ?>
		</div>
	</div>
</div>

<div class="hmcntin" style="margin-top:0;">
<div class="row">
<div class="col-sm-12">
	<div class="hmcntinright" >
		<div class="table-responsive marbtm10">
				<div class="thankcnt">
					<h2>Thank you for posting your ad on Fxchng.</h2>

					<p>Your ad will go live after passing through a quality check.</p>

					<p>To view, edit or delete your ad - Go to your Fxchng Dashboard.</p>

					<p><strong>Share your ad with your friends</strong> to gain maximum visibility and quick results.</p>

					<!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
					<a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php echo $this->base. '/categories/product_detail/'. $ad_id; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
					<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=<?php echo $this->base. '/categories/product_detail/'. $ad_id; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
					<a href="https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=<?php echo $this->base. '/categories/product_detail/'. $ad_id; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/pinterest.png" border="0" alt="Pinterest"/></a>
					<a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php echo $this->base. '/categories/product_detail/'. $ad_id; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
					<a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=<?php echo $this->base. '/categories/product_detail/'. $ad_id; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="LinkedIn"/></a>

					<p></p>
					<p>
						<?php
							// echo $this->Html->link('Edit Your ad',
							// 	array('controller' => 'ad_posts', 'action' => 'edit_post', $ad_id)
							// 	);
						?>
					</p>
					<p>
						<?php if (isset($ad_id) && $ad_id != null || $ad_id != '') {
							echo $this->Html->link('View Your ad',array('controller' => 'categories', 'action' => 'product_detail', $ad_id));
						} ?>
					</p>
					<p>Thank you for using Fxchng and good luck with your ad!</p>

				</div>

			<p></p>
		</div>
	</div>
</div>
</div>
</div>
<?php $this->end('page-wrapper'); ?>