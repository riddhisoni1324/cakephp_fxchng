<?php echo $this->start('page-wrapper'); ?>
<?php //echo $this->element('dashboard');?>
<!-- <div class="fxloginadminarea"> from dashboard.ctp -->

<div class="container">  
  <div class="fxloginnamberright">
    <div class="clear"></div>
  </div>
  <div class="fxlogingreayarea">

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div>
          <div class="dateandtime">
            <div class="datenew"><span class="block">Wednesday</span>17<span>Jun 2015</span></div>
            <div class="timenew"><span id="am" class="am">PM</span><label class="timenew1" id="timenew1">12:03</label></div>
            <div class="clear"></div>
          </div>
          <div class="clear"></div>
        </div>
        <h1>My Ads</h1><br>
      </div>  
    </div>
    <?php
      if ($activeUser) { ?>
        <div>
      <div class="row">
        <div class="col-md-12">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">ACTIVE ADS MANAGEMENT</h3>
            </div>
            <div class="panel-body">
              <?php                
                  echo $this->element('myAdList');                
              ?>
            </div> <!-- end of panel body -->
          </div>

        </div>  
      </div>
    </div>
      <?php }
      else {
        echo "<h3>Please login to see your ads or refresh if you already logged in.</h3>";
      }                 
    ?>
    
      
  </div>  
</div> <!-- end of container -->

<?php echo $this->end('page-wrapper'); ?>
