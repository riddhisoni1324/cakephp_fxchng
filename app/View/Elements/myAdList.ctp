
<!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
<!-- <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php //echo $this->base. '/categories/product_details'; ?>" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=<?php //echo $this->base. '/categories/product_details'; ?>" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
<a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=http%3A%2F%2Ffxchng.com&pubid=ra-557e676d3567cc2f&ct=1&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/addthis.png" border="0" alt="Addthis"/></a> -->


<div class="">
	<div id="mcategoryid">
		<?php if($activeUser != null) { ?>
		 	<div class="table-responsive marbtm10">
				<ul class="category_product_container">
				<?php
					if(sizeof($items)>0) {
			 			foreach ($items as $item) {
			 	?>
		 	 	<li>
		 			<div class="">
			 			<div class="hmcntinright2">
			    			<div class="proimg">
			    					<?php
			    						if(isset($item['doc']['primary_photo'])) {
			    					?>
										<?php echo $this->Html->image($PHOTO_PATH.$item['doc']['primary_photo']['dir'].'/sm_'.$item['doc']['primary_photo']['filename'], array('alt' => 'No Image', 'url'=>array('controller'=>'categories', 'action'=> 'product_detail', $item['doc']['_id'])));?>
		    						<?php
									}
									else {
										echo $this->Html->image('noimage.png', array('alt' => 'No Image'));
									}
		    						?>
			    			</div> <!-- end of class="proimg" -->

			    			<div class="prodetail">
								<?php
									echo $this->Html->link(substr(ucfirst($item['doc']['title']),0,40),
										array('controller'=>'categories', 'action'=> 'product_detail', $item['doc']['_id']),
										array('title' => $item['doc']['title'],'class'=>'main-item-name-list' ));
								?>
								<span class="title" style="margin:0; padding:0;">
									<?php if(strlen($item['doc']['title'])>=50) {
										echo $this->html->link('...',array(
													'url'=>array('controller'=>'', 'action'=>'')
													));
									}?>
								</span>

								<span class='locationdetail'>
									<?php
										echo $item['doc']['item_type']['name']. ' | '. $item['doc']['item_category']['name'];
									?>
									<strong>
										<?php
											echo $item['doc']['personal_info']['area'];
										?>
									</strong>
								</span>

								<span class="prodetail-desc">
									<p>
										<?php

											echo $item['doc']['description'];
										?>
									</p>
								</span>

								<div class="prodetail-stuff">

						            <div class="visitor">
							            <span><label>12</label>Visitors </span>
						            </div>


				        			<div class="shortlistnotlogin">
				        				<a class="myButton showSingle" data-target="#basicModal_fav" href="#" data-toggle="modal">Shortlist</a>
			        				</div>

									<?php
									// set date
									$created_date = $item['doc']['created'];
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
									<div class="boxdayandtime">
										<span>
											<?php echo $daycnt.' '.date('h:i:s A',strtotime($created_date));?>
										</span>
		                				<label style="display:none;" class="reportspam reposttospan">
		                					Thank you for your Feedback.
		                				</label>
									</div>

									<?php
										if ($FB_ID) {
									?>
										<div class="reportspam">
	                    					<a>Report</a>
	                    				</div>
									<?php } ?>

								</div>

			    			</div> <!-- end of class="prodetail" -->

			    			<div class="proprice">
			    				<p>Price</p>
			    				<div class="rupee">र <?=(number_format( $item['doc']['price'])) ?></div>
			    			</div> <!-- end of class="proprice" -->

			    			<div class="proowner">
			    				<div class="namebox">

			    					<div class="name">
			    						<div class="name1"></div>
			    						<?php if ($activeUser != null) { ?>
			    						<div class="name2">
			    							<img src="<?php echo $item['doc']['personal_info']['fb_pic']; ?>" class="show_fb_pic">
			    						</div>
			    						<div class="username">
			    							<?php echo $item['doc']['personal_info']['name']; ?>
			    						</div>
	    								<?php } else { ?>
	    								<div class="name2">
			    							<?php echo $this->Html->image('img_candiate.jpg', array('class' => '')); ?>
			    						</div>
			    						<div class="username">

			    						</div>
	    								<?php } ?>
			    					</div>
			    				</div>


								<?php if ($activeUser == null) { ?>
			    				<div class="fb-btn">
			    					<button type="button" class="fb-btn fb_auth hide_fb"> <i class="fa fa-facebook-official"></i> Signup </button>
		    					</div>
		    					<?php } ?>

			    			</div> <!-- end of class="proowner" -->
			    			<div class="clear"></div>

							<?php if ($item['doc']['personal_info']['fb_id'] === $activeUser['User']['fb_id']) { ?>
								<div class="row">
					    			<div class="col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4">
						    			<div class="row ads-utilities">
						    				<div class="col-md-3 col-sm-3">
						    					<!-- <button type="submit"><i class="fa fa-pencil"></i>edit</button> -->
												<a href="<?php echo $this->base. '/ad_posts/edit_post/'. $item['doc']['_id'] ?>"><i class="fa fa-pencil"></i>edit</a>
					    					</div>
						    				<div class="col-md-3 col-sm-3">
						    					<button type="submit"><i class="fa fa-eye"></i>view</button>
					    					</div>
						    				<div class="col-md-3 col-sm-3">
						    					<button type="submit"><i class="fa fa-check-circle-o"></i>completed</button>
					    					</div>
						    				<div class="col-md-3 col-sm-3">
						    					<button type="submit"><i class="fa fa-remove"></i>cancel</button>
					    					</div>
										</div>
									</div>
								</div>
							<?php } ?>

			    		</div> <!-- end of class = "hmcntinright2" -->
		    		</div>
		    	</li>
			 	<?php } } else { ?>
		 			 <div class="table-responsive marbtm10">
	        			<div class="info2">No records found.</div>
	        		</div>
		 		<?php } ?>
			 	</ul>
	    	</div> <!-- end table responsive -->
	    <?php } ?>
	</div> <!-- end of id="mcategoryid" -->
</div> <!-- end of class="" -->