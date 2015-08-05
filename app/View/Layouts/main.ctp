<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php echo $this->Html->charset(); ?>

	<title>
		<?php echo $title_for_layout; ?> | Fxchng
	</title>

	<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->

	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('style');
		echo $this->Html->css('style2');
		echo $this->Html->css('reset');
		echo $this->Html->css('fonts');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('prettyPhoto');
		echo $this->Html->css('new_look');
		echo $this->Html->css('admin/jqueryui');
		echo $this->Html->css('font-awesome');

		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('popover');
		echo $this->HTML->script('jquery-ui');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

	<script type="text/javascript">
		// set flash message timeout
		$(document).ready(function () {
			$(".alert").fadeOut(5000);
		});

		// set base path.
		var baseUrl = "<?php echo $this->webroot; ?>";
		var is_open = "<?php echo $is_open ?>"; // check site was open or not
	</script>

	<style type="text/css">
		.alert {
			position:absolute;
		}
	</style>

</head>
<body>
	<?php
		// for FB Authenticaton
		 echo $this->HTML->script('fb_login/fb_login');
	?>

	<?php echo $this->Session->flash('success'); ?>
    <?php echo $this->Session->flash('error'); ?>

	<?php //echo $this->element('searchMobile'); ?>
	<?php echo $this->element('Header'); ?>
	<?php // echo $this->element('dashboard'); ?>
	<?php echo $this->fetch('page-wrapper'); ?>
	<?php echo $this->element('footer'); ?>
</body>
</html>