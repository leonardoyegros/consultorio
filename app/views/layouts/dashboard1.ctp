
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $html->charset(); ?>
	<title>
		<?php __('SISO | '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		// echo $html->meta('icon');
		// echo $html->css('cake.generic');

		echo $html->css('bootstrap.min');
		echo $html->css('bootstrap-select');
		echo $html->css('bootstrap-datepicker');
		echo $html->css('hr');


		echo $javascript->link('jquery.min');
		echo $javascript->link('bootstrap.min');
		echo $javascript->link('tooltip');
			

		echo $javascript->link('bootstrap-select');

		echo $javascript->link('bootstrap-datepicker');
		echo $javascript->link('bootstrap-datepicker.min');	


		echo $javascript->link('hr');

		// echo $scripts_for_layout;
	?>
</head>
<body>
	<?php echo $this->element('topmenu');?>

	<div class="container-fluid">
		<div class="row">
			<!-- SIDEBAR -->
			
			<div class="flashMsg">
				<?php //if ($session->check('Message.flash')): echo $session->flash(); endif; ?>
			</div>


			

			<!-- CONTENIDO-->
			<div id="col-content">			
				<ol class="breadcrumb">
					<li><a href="/leo/siso13/siso1.3/documents"><?php echo __("Dashboard", true);?></a>  </li>	
					<div id="dashboard_fiter">
				<div class="row">
					<div class="col-md-12">
						<span class="glyphicon glyphicon-calendar"></span>
						<input class="datepicker ">
					</div>
				</div>
				</ol>


			</div>


			</div>
				<?php
					echo $this->element('navbar');
				?>		       
		        <!-- <div id="content"> -->
		        <div id="histograms">

		        	<?php echo $content_for_layout; ?>
		        </div>
		        <!-- </div> -->
		    <!-- </div> -->
		    <div id="filter-content">
		    	<?php ?>
		    </div>
	    </div>
	</div>
	<!-- <div id="sql_dump"><?php echo $this->element('sql_dump'); ?></div> -->
</body>




