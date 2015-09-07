<?php
	// $cakeDescription = __d('cake_dev', 'SISO');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>
		SISO |
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		
		// echo $this->Html->chunk_split(body)s('cake.generic');
		
		// echo $this->fetch('meta');
		// echo $this->fetch('css');
		// echo $this->fetch('script');

		echo $this->Html->meta('icon');

		//HR
		
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('hr');

		echo $this->Html->css('bootstrap-select');
		echo $javascript->link('bootstrap-datepicker');
		echo $javascript->link('bootstrap-datepicker.min');	
		
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
						<span id="calendar_dashboard" class="glyphicon glyphicon-calendar "></span>
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



</html>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
<?php 
	echo $this->Html->script('jquery.min');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('tooltip');
	echo $this->Html->script('hr');	
	echo $this->Html->script('bootstrap-select');
	

?>
