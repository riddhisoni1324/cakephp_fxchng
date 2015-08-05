<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
  <!--<a class="navbar-brand" href="#">Bootstrap theme</a>-->
</div>
<div class="bgnavi navbar-collapse collapse">
<div class="container">
  <ul class="nav navbar-nav" style="border-left:1px solid #158894;">

       <?php foreach ($main_nav_items as $items_types) { ?>
           <li class="dropdown" class="dropdown-toggle">
            <a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'index', $items_types['ItemType']['id']));?>">
              <div>
                <img src="<?php echo $item_image.$items_types['ItemType']['id'].'/'.$items_types['ItemType']['image_file']; ?>">
              </div>
              <?php
                echo $items_types['ItemType']['name'];
              ?></a>
            <ul class="dropdown-menu">
              <?php
                foreach ($items_types['ItemCategory'] as $categories) { ?>
                  <li class=""><a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'sub_category_items', $categories['id']));?>"><?php echo $categories['name']; ?></li></a>
                <?php } ?>
            </ul>
          </li>
      <?php } ?>
    <div class="clear"></div>
  </ul>
<!-- </li> -->
</div>
</div>

