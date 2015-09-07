
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="http://www.getsiso.com/wp-content/themes/startuply/images/favicon.ico">
	<?php echo $html->charset(); ?>
	<title>
		<?php __('SISO | '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		// echo $html->meta('icon');
		// echo $html->css('cake.generic');

		//tablas
		// echo $html->css('jq');
		echo $html->css('theme.default.min');

		echo $html->css('bootstrap.min');


		echo $javascript->link('jquery.min');
		echo $javascript->link('bootstrap.min');

	
		

		// echo $scripts_for_layout;
	?>
</head>

<div id="modals-float">
<?php echo $content_for_layout; ?>
</div>

<style type="text/css">
	#modals-float .nav-tabs{
		display: none;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#modals-float .panel-default:first').show();
	});
	
</script>