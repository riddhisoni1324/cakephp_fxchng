
<ul class="category_product_container">
<?php
	if(sizeof($items)>0)
	{
?>
	<?php
		foreach ($items as $item) {
	?>
	<li>
	 			<div class="">
		 			<div class="hmcntinright2">
		    			<div class="proimg">	    				
		    					<?php
		    						if(isset($item['value']['primary_photo'])) {
		    					?>		    															
									<?php echo $this->Html->image($PHOTO_PATH.$item['value']['primary_photo']['dir'].'/sm_'.$item['value']['primary_photo']['filename'], array('alt' => 'No Image', 'url'=>array('controller'=>'', 'action' => '')));?>								
	    						<?php
								}
								else { 
									echo $this->Html->image('noimage.png', array('alt' => 'No Image'));
								}
	    						?>		    				
		    			</div> <!-- end of class="proimg" -->

		    			<div class="prodetail">
							<?php
								echo $this->Html->link(substr(ucfirst($item['value']['title']),0,40), 
									array('controller'=>'categories', 'action'=> 'product_detail', $item['value']['id']), 
									array('title' => $item['value']['title'] ));
							?>
							<span class="title">
								<?php if(strlen($item['value']['title'])>=50) { 
									echo $this->html->link('...',array(
												'url'=>array('controller'=>'', 'action'=>'')
												)); 
								}?>
							</span>

							<br>

							<span class='locationdetail'>
								<?php
									echo $item['value']['item_type']['name']. ' | '. $item['value']['item_category']['name'];
								?>
								<strong>
									<?php
										echo $item['value']['user']['area'];
									?>
								</strong>
							</span>

							<span>
								<p>
									<?php
										$desc = $item['value']['description'];
										echo substr(utf8_encode($desc),0,80);
										if(strlen(utf8_encode($desc))>=80) {
											echo $this->html->link('...more',array(
												'url'=>array('controller'=>'', 'action'=>'')
												));
										}
									?>
								</p>
							</span>
								
						
							<?php
								// set date
								$created_date = $item['value']['created'];
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
								<?php
									if ($FB_ID) { 
								?>
									<div class="reportspam">								 		
                    					<a>Report</a>	                    				
                    				</div>
								<?php	}
									?>
							 	
                				<label style="display:none;" class="reportspam reposttospan">
                					Thank you for your Feedback.
                				</label>

							</div>

		    			</div> <!-- end of class="prodetail" -->

		    			<div class="proprice">
		    				<div class="rupee">र <?=(number_format( $item['value']['price']))?></div>
		    			</div> <!-- end of class="proprice" -->

		    			<div class="proowner">
		    				<div class="namebox">
		    					<div class="name">
		    						<div class="name1"></div>
		    						<div class="name2">
		    							<?php
		    								if ($FB_ID) {
		    									echo $this->html->image('img_candiate.jpg'); // set fb image
		    								}
		    								else {
		    									echo $this->html->image('img_candiate.jpg');
		    								}
		    							?>
		    						</div>
		    					</div>
		    				</div>
		    			</div> <!-- end of class="proowner" -->

		    			<div class="clear"></div>
						
						<?php 
							if ($FB_ID) {
						?>
							<div class="commonfrds">
					            <h4>Common<br>
					                Friends
					            </h4>
					            <div class="logoutdisplydiv logoutdisplydiv1 marginleftnone">
					                <p>You have "0" mutual connections.<br>Increase your Social Circle Now!.</p>
					                <span>
					                	<a href="#" target="_BLANK">
					                		<img 
					                			src="<?php echo $this->base."/img/btn_invite_friends_hover.jpg";?>"alt="" class="fbimg2" 
					                			onmouseover="this.src='<?php echo $this->base."/img/btn_invite_friends.jpg" ;?>'" 
					                			onmouseout="this.src='<?php echo $this->base."/img/btn_invite_friends_hover.jpg" ;?>'">
					                	</a>
					                </span>
					                <div class="clear"></div>
					            </div> 
					        </div> <!-- end of class="commonfrds" -->
						<?php 
							}
							else { 
						?>
					     	<div class="logoutdisplydiv">
						        <p>Signup / Login with Facebook to find your mutual connections.</p>
						        <span>
						        	<a>
						        		<img src="<?php echo $this->base."/img/btn_facebooklogin.jpg";?>" 
						        		onmouseover="this.src='<?php echo $this->base."/img/btn_facebooklogin_hover.jpg" ;?>'" onmouseout="this.src='<?php echo $this->base."/img/btn_facebooklogin.jpg" ;?>'" alt="">
						        	</a>
						        </span>
						        <div class="clear"></div>
						    </div>
						<?php 
								}							
						?>
		    			

		    			<div class="buttons">
				            <div class="visitor">
					            <span><label>12</label></span>Visitors
				            </div>				          
				            <div class="shortlistnotlogin"><a class="myButton showSingle" data-target="#basicModal_fav" href="#" data-toggle="modal">Shortlist</a></div>			           
				        </div> <!-- end of class = "buttons" -->

		    			<div class="clear"></div>
		    		</div> <!-- end of class = "hmcntinright2" -->
	    		</div>
	    	</li>
	<?php
		}
	?>
</ul>
 <?php
    }
    else{
        echo "done";
    }
?>
