<div class="">
	<div id="mcategoryid">
	 	<div class="table-responsive marbtm10">

			<ul class="category_product_container">
			<?php if(sizeof($items)>0) { foreach ($items as $item) { ?>
	 	 	<li>
	 			<div class="">
		 			<div class="hmcntinright2">
		    			<div class="proimg" style="margin-top:5px;">
		    					<?php
		    						if(isset($item['doc']['primary_photo'])) {
		    					?>
									<?php echo $this->Html->image($PHOTO_PATH.$item['doc']['primary_photo']['dir'].'/sm_'.$item['doc']['primary_photo']['filename'], array('alt' => 'No Image', 'url'=>array('controller'=>'categories', 'action' => 'product_detail', $item['doc']['_id'])));?>
	    						<?php
								}
								else {
									echo $this->Html->image('default.jpg', array('alt' => 'No Image', 'class' => 'img-responsive'));
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
									echo '...';
								}?>
							</span>

							<span class='locationdetail'>
								<?php
									echo $item['doc']['item_type']['name']. ' | '. $item['doc']['item_category']['name'];
								?>
								<strong>
									<?php
										if ($location != null) {
											echo ' | '.$item['doc']['personal_info']['area'];
										} else {
											echo ' | '.$item['doc']['personal_info']['city'];
										}
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
			        				<a class="myButton showSingle" data-target="#basicModal_fav" href="#" data-toggle="modal">*</a>
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
	                				<!-- <label style="display:none;" class="reportspam reposttospan">
	                					Thank you for your Feedback.
	                				</label> -->
								</div>

								<?php
									if ($FB_ID) {
								?>
									<!-- <div class="reportspam">
                    					<a>Report</a>
                    				</div> -->
                    				<div class="addon_mutual_img">
                    					Common Friends : &nbsp;
                    					<?php foreach ($item['doc']['FbFriend'] as $friend_details) {
			                        // pr($item_detail['personal_info']['email']);
	                             	if ($friend_details['mutual_friend_pic'] != null) { ?>
	                                    <!-- <a href="#" class = "" data-toggle="tooltip" data-placement="top" title="<?php //echo $friend_details['mutual_friend_name']; ?>" data-email = "<?php //echo $friend_details['email']; ?>"> -->
                                        <?php  echo $this->html->image($friend_details['mutual_friend_pic'], array('title' => $friend_details['mutual_friend_name'], 'class' => '')); ?>
	                                    <!-- </a> -->
			                    		<?php } } ?>
                    				</div>
								<?php } ?>

							</div>

		    			</div> <!-- end of class="prodetail" -->

		    			<div class="proprice">
		    				<p>Price</p>
		    				<div class="rupee">र <?=(number_format( $item['doc']['price']))?></div>
		    			</div> <!-- end of class="proprice" -->
		    			<div class="proowner">
		    				<div class="namebox">

		    					<div class="name">
		    						<div class="name1"></div>
		    						<?php if ($activeUser != null) { ?>
		    						<div class="name2">
		    							<!-- <img src="<?php //echo $item['doc']['personal_info']['fb_pic']; ?>" class="show_fb_pic"> -->
		    							<img src="https://graph.facebook.com/<?php echo $item['doc']['personal_info']['fb_id']; ?>/picture?type=square" class="show_fb_pic">
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
	    					<?php } else { ?>

	    					<?php } ?>
		    			</div> <!-- end of class="proowner" -->

		    			<div class="clear"></div>
		    			<div class="clear"></div>
		    		</div> <!-- end of class = "hmcntinright2" -->
	    		</div>
	    	</li>
		 	<?php } } else { ?>
	 			<!-- echo ''; -->
	 			<div class="table-responsive marbtm10">
        			<div class="info2">No records found.</div>
        		</div>
	 		<?php } ?>
		 	</ul>
    	</div> <!-- end table responsive -->
	</div> <!-- end of id="mcategoryid" -->
</div> <!-- end of class="" -->