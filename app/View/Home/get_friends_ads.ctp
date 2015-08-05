<?php echo $this->start('page-wrapper'); ?>

<?php if ($activeUser != null) { ?>
    <?php echo $this->element('categoryList'); ?>
<?php } ?>

<?php echo  $this->end('page-wrapper'); ?>