<div class="detailareanew">
  <div class="detailimages">
      <div class="col-md-12 paddall10">

        <div class="row">
          <div class="col-md-6 col-sm-6">
            <!-- gallery large and thumbnails -->
            <div class="bannerslider">
              <div class="pgwSlideshow wide">
                <div class="ps-current">
                  <ul class="post_ad_large">
                    <li>
                      <?php  if(isset($item_detail['primary_photo'])) { ?>
                          <img class="zoom_image" src="<?php echo $this->base."/files/item_photo/image_file/".$item_detail['primary_photo']['dir']."/md_".$item_detail['primary_photo']['filename'];?>" data-zoom-image="<?php echo $this->base."/files/item_photo/image_file/".$item_detail['primary_photo']['dir']."/".$item_detail['primary_photo']['filename']; ?>"/>
                      <?php } else {
                        echo $this->Html->image('default.jpg', array('class'=>'img-responsive'));
                      } ?>
                    </li>
                  </ul>
                  <span class="ps-caption"></span>
                </div>
                <?php  if(isset($item_detail['primary_photo'])) { ?>
                <div class="ps-list" id="gallery_01">
                  <span class="ps-prev"><span class="ps-prevIcon"></span></span>
                   <ul class="post_ad_thumb">
                     <li>
                        <a href="#"  class="ps-item" data-image="<?php echo $this->base."/files/item_photo/image_file/".$item_detail['primary_photo']['dir']."/md_".$item_detail['primary_photo']['filename'];?>" data-zoom-image="<?php echo $this->base."/files/item_photo/image_file/".$item_detail['primary_photo']['dir']."/".$item_detail['primary_photo']['filename']; ?>">
                        <img id="img_01" style="border:1px solid gray" src="<?php echo $this->base."/files/item_photo/image_file/".$item_detail['primary_photo']['dir']."/sm_".$item_detail['primary_photo']['filename']; ?>" />
                        </a>
                     </li>
                      <?php if(isset($item_detail['photo'])) {
                          foreach ($item_detail['photo'] as $key => $value) { ?>
                        <li>
                          <a href="#" class="ps-item" data-image="<?php echo $this->base."/files/item_photo/image_file/".$value['dir']."/md_".$value['filename']; ?>" data-zoom-image="<?php echo $this->base."/files/item_photo/image_file/".$value['dir']."/".$value['filename']; ?>">
                            <img id="img_01<?php echo $key; ?>" style="border:1px solid gray; margin-bottom:5px;" src="<?php echo $this->base."/files/item_photo/image_file/".$value['dir']."/sm_".$value['filename']; ?>" />
                          </a>
                        </li>
                       <?php } }  ?>
                    </ul>
                    <span class="ps-next">
                      <span class="ps-nextIcon">
                      </span>
                    </span>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <!-- detail heading -->
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="title" data-toggle="tooltip" data-placement="top" title="<?php echo $item_detail['title'] ;?>" data-original-title="">
                  <span style="font-size:30px;"><?php echo $item_detail['title'] ;?></span>
                </div>
                  <span class='locationdetail'>
                    <?php
                      echo $item_detail['item_type']['name']. ' | '. $item_detail['item_category']['name']. ' | in ';
                    ?>
                    <strong>
                      <?php
                        echo $item_detail['personal_info']['area']. ', '.$item_detail['personal_info']['city'];
                      ?>
                    </strong>
                  </span>
              </div>
              <!-- item price -->
              <div class="col-md-12 col-sm-12">
                <div class="detailprice">
                  <div class="detailpricein">र <?=(number_format($item_detail['price']))?></div>
                </div>
              </div>
              <!-- utility stuff -->
              <div class="col-md-12">
                <div class="mobileclass item_utilities">
                  <div class="row">
                    <div class="col-md-3">
                      <p class="detailvisiter paddtopvisitors">
                        <i class="fa fa-users"></i>
                        <label>8 </label> visitors
                      </p>
                    </div>
                    <div class="col-md-3">
                      <div class="shortlistnotlogin floatleft">
                        <a class="myButton showSingle " data-toggle="modal">
                          <i class="fa fa-star"></i>
                          Shortlist
                        </a>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="boxdayandtime">
                        <i class="fa fa-clock-o"></i>
                        <span> 18-06-15 03:58 PM </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="reportspam_head">
                        <a data-container="body">
                          <i class="fa fa-envelope-square"></i>
                          Report
                        </a>
                      </div>
                    </div>
                    <label style="display:none;" class="reportspam reposttospan">
                      Thank you for your Feedback.
                    </label>
                  </div>
                </div>
              </div>

              <!-- item description view -->

              <div class="col-md-12">
                <br>
                <table class="table table-striped">
                  <tbody>

                    <!-- for mobile -->
                      <?php if ($item_detail['item_type']['id'] === '55680b32-400c-4133-97a5-1dd4bf642048') { ?>
                        <tr>
                          <td><strong>Want:</strong></td>
                          <td><?php echo $item_detail['i_want_to']; ?></td>
                          <td><strong>Condition:</strong></td>
                          <td><?php echo $item_detail['condition']; ?></td>
                        </tr>

                        <tr>
                          <td><strong>Brand:</strong></td>
                          <td><?php echo $item_detail['brand']['name']; ?></td>
                          <td><strong>How Old/Usage:</strong></td>
                          <td><?php echo $item_detail['usage']; ?></td>
                        </tr>

                        <tr>
                          <td><strong>Also Includes:</strong></td>
                          <td>
                            <?php if (!empty($item_detail['included'])) { ?>
                              <?php foreach ($item_detail['included'] as $value) {
                                echo $value.'<br>';
                            } }?>
                          </td>
                          <td></td>
                          <td></td>
                        </tr>
                      <?php } else if ($item_detail['item_type']['id'] === '55683520-6028-48f4-95ff-691dbf642048' || $item_detail['item_type']['id'] === '55685b20-192c-4cab-b473-0a5bbf642048' || $item_detail['item_type']['id'] === '55685b98-caec-4fc3-aac4-4496bf642048') { ?>
                          <tr>
                            <td><strong>Want:</strong></td>
                              <td><?php echo $item_detail['i_want_to']; ?></td>
                              <td><strong>Condition:</strong></td>
                              <td><?php echo $item_detail['condition']; ?></td>
                          </tr>
                          <tr>
                              <td><strong>Brand:</strong></td>
                              <td><?php echo $item_detail['brand']['name']; ?></td>
                              <td><strong>How Old/Usage:</strong></td>
                              <td><?php echo $item_detail['usage']; ?></td>
                          </tr>
                        <?php } else if ($item_detail['item_type']['id'] === '55685b5e-3934-4e8e-87b9-0a5cbf642048') { ?>
                          <tr>
                            <td><strong>Want:</strong></td>
                              <td><?php echo $item_detail['i_want_to']; ?></td>
                              <td><strong>Condition:</strong></td>
                              <td><?php echo $item_detail['condition']; ?></td>
                          </tr>
                        <?php } else if ($item_detail['item_type']['id'] === '5568353e-8100-4254-936e-2cb0bf642048') { ?>
                          <?php if ($item_detail['item_category']['id'] === '556ea983-7e90-4fc7-b7d0-0c7bbf642048'){ ?>
                            <!-- for resumes from JOB type -->
                            <tr>
                                <td><strong>Education:</strong></td>
                                <td><?php echo $item_detail['jobs']['Role']['education']; ?></td>
                                <td><strong>Experience</strong></td>
                                <td><?php echo $item_detail['jobs']['experience']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Job Type:</strong></td>
                                <td><?php echo $item_detail['job_type']; ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                          <?php } else { ?>
                            <!-- remain of all from Jobs -->
                            <tr>
                                <td><strong>Want:</strong></td>
                                <td><?php echo $item_detail['i_want_to']; ?></td>
                                <td><strong>Company Name:</strong></td>
                                <td><?php echo $item_detail['jobs']['company_name']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td><?php echo $item_detail['jobs']['Role']['name']; ?></td>
                                <td><strong>Designation</strong></td>
                                <td><?php echo $item_detail['jobs']['designation']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Education:</strong></td>
                                <td><?php echo $item_detail['jobs']['Role']['education']; ?></td>
                                <td><strong>Experience</strong></td>
                                <td><?php echo $item_detail['jobs']['experience']; ?></td>
                            </tr>
                          <?php } ?> <!-- end of Jobs category -->
                        <?php } else if ($item_detail['item_type']['id'] === '55680b42-e360-4882-8274-1b96bf642048') { ?>
                          <!-- for  automobiles -->
                          <?php if ($item_detail['item_category']['id'] === '55680d26-bda8-4af7-bd4a-1cfabf642048') { ?>
                          <!-- for cars -->
                          <tr>
                            <td><strong>Want:</strong></td>
                            <td><?php echo $item_detail['i_want_to']; ?></td>
                            <td><strong>Condition:</strong></td>
                            <td><?php echo $item_detail['condition']; ?></td>
                          </tr>

                           <tr>
                              <td><strong>Brand:</strong></td>
                              <td><?php echo $item_detail['brand']['name']; ?></td>
                              <td><strong>Insurance till:</strong></td>
                              <td><?php echo $item_detail['valid_till']; ?></td>
                          </tr>

                          <tr>
                              <td><strong>Year:</strong></td>
                              <td><?php echo $item_detail['year']; ?></td>
                              <td><strong>Kms Driven:</strong></td>
                              <td><?php echo $item_detail['kms_driven']; ?></td>
                          </tr>

                          <tr>
                              <td><strong>Fuel Type:</strong></td>
                              <td><?php echo $item_detail['fuel_type']; ?></td>
                              <td></td>
                              <td></td>
                          </tr>
                          <?php } else if ($item_detail['item_type']['id'] === '556ea1ef-87a4-4828-aecc-0c7abf642048') { ?>
                          <!-- for other vehicles -->
                          <tr>
                            <td><strong>Want:</strong></td>
                            <td><?php echo $item_detail['i_want_to']; ?></td>
                            <td><strong>Condition:</strong></td>
                            <td><?php echo $item_detail['condition']; ?></td>
                          </tr>

                          <tr>
                              <td><strong>Year:</strong></td>
                              <td><?php echo $item_detail['year']; ?></td>
                              <td><strong>Fuel Type:</strong></td>
                              <td><?php echo $item_detail['fuel_type']; ?></td>
                          </tr>
                          <?php } else if ($item_detail['item_type']['id'] === '556ea2b3-2dac-4d08-b493-0d7ebf642048') { ?>
                          <!-- for commercial - transportation -->
                          <tr>
                            <td><strong>Want:</strong></td>
                            <td><?php echo $item_detail['i_want_to']; ?></td>
                            <td><strong>Condition:</strong></td>
                            <td><?php echo $item_detail['condition']; ?></td>
                          </tr>

                          <tr>
                            <td><strong>Vehicle Type:</strong></td>
                            <td><?php echo $item_detail['vehicle_type']; ?></td>
                            <td></td>
                            <td></td>
                          </tr>

                          <?php } else if ($item_detail['item_type']['id'] === '556ea2dc-68ac-4419-a951-0c7cbf642048' || $item_detail['item_type']['id'] === '556ea30e-93e0-4add-9bdb-0dbfbf642048') { ?>
                          <!-- for spare part , Tractors - Agricultural Equipments -->
                          <tr>
                            <td><strong>Want:</strong></td>
                            <td><?php echo $item_detail['i_want_to']; ?></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <?php } ?> <!-- end of automobiles if -->

                        <?php } else if ($item_detail['item_type']['id'] === '55680b42-e360-4882-8274-1b96bf642048') { ?>
                          <!-- for community & events -->
                          <?php if ($item_detail['item_category']['id'] === '556ea9c6-bb64-40c6-b60b-150cbf642048') { ?>
                            <!-- for Carpool & Bike Ride Share -->
                            <tr>
                              <td><strong>Want:</strong></td>
                              <td><?php echo $item_detail['i_want_to']; ?></td>
                              <td></td>
                              <td></td>
                          </tr>
                           <?php } else if ($item_detail['item_category']['id'] === '556eaa04-8864-4c36-bddd-0d7ebf642048' || $item_detail['item_category']['id'] === '556eaa0e-dbac-4c8c-a479-0c7ebf642048' || $item_detail['item_category']['id'] === '556eaa17-79bc-4d0c-b7da-157abf642048' || $item_detail['item_category']['id'] === '556eaa21-7b38-4bb8-9d7e-0c7bbf642048') { ?>
                            <!-- for all events-->
                          <tr>
                            <td><strong>Event Date:</strong></td>
                            <td><?php echo $item_detail['event_date']; ?></td>
                            <td><strong>Venue:</strong></td>
                            <td><?php echo $item_detail['venue']; ?></td>
                          </tr>
                          <?php } ?> <!-- end of community events if -->
                        <?php } else if ($item_detail['item_type']['id'] === '55680b42-e360-4882-8274-1b96bf642048') { ?>
                          <!-- for real estate -->
                          <tr>
                              <td><strong>Want:</strong></td>
                              <td><?php echo $item_detail['i_want_to']; ?></td>
                              <td><strong>Area:</strong></td>
                              <td><?php echo $item_detail['real_estate']['area']; ?></td>
                          </tr>

                          <tr>
                              <td><strong>City:</strong></td>
                              <td><?php echo $item_detail['real_estate']['city']; ?></td>
                              <td></td>
                              <td></td>
                          </tr>
                      <?php } ?> <!-- end of main if -->

                  </tbody>
                </table>
              </div>
            </div>
            <br><br>
            <div class="row">
            <div class="col-md-12">
              <div class="floatright mobilecass1">
                <p class="detailvisiter">Share on : </p>
                  <ul class="sharebtn floatleft">
                  <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
                  <a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
                  <a href="https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/pinterest.png" border="0" alt="Pinterest"/></a>
                  <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
                  <a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="LinkedIn"/></a>
                  </ul>
              </div>
            </div>
        </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
          <h4 style="color:#e56f18;border-bottom:1px solid #A0A0A0; padding: 7px 7px 7px 0;">Description</h4>
            <div class="">
              <p class="">
                <?php
                  echo $item_detail['description'];
                ?>
              </p>
            </div>
          </div>
        </div>

       <!--  <div class="row">
          <div class="col-md-12">
            <div class="floatright mobilecass1">
              <p class="detailvisiter">Share on</p>
                <ul class="sharebtn floatleft">
                <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/pinterest.png" border="0" alt="Pinterest"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
                <a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=<?php echo $this->base. '/categories/product_detail/'. $item_detail['_id']; ?>" target="_blank" class = 'close_modal'><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="LinkedIn"/></a>
                </ul>
            </div>
          </div>
        </div> -->
        <div class="clear"></div>
      </div> <!-- end of class = paddall10 -->

  </div> <!-- class = detailimages -->
</div> <!-- class = detailareanew -->