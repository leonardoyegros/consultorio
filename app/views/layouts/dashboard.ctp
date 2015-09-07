<?php //print_r($receivables); die();?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="http://www.getsiso.com/wp-content/themes/startuply/images/favicon.ico">
	<?php echo $html->charset(); ?>
	<title>
		<?php __('SISO (Beta) | '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		// echo $html->meta('icon');
		// echo $html->css('cake.generic');

		echo $html->css('bootstrap.min');
		echo $html->css('bootstrap-select');
		echo $html->css('bootstrap-datepicker');
		echo $html->css('hr');
		echo $html->css('dashboard');


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

			<?php 
			    $from = !empty($_GET['from']) ? $_GET['from'] : date('Y-m-01');
			    $to = !empty($_GET['to']) ? $_GET['to'] : date('Y-m-d');
			?>
			

			<!-- CONTENIDO-->
			<div id="col-content">			
				<ol class="breadcrumb">
					<li><a href="/leo/siso13/siso1.3/documents"><?php echo __("Dashboard", true);?></a>  </li>	
					<div id="dashboard_fiter">
						<div class="row">
							<div class="col-md-12">
								<span class="glyphicon calendar_dashboard glyphicon-calendar ">
								<!-- <span class="glyphicon glyphicon-calendar"> -->
								<form id="filter">
									<input class="datepicker dashboard_datepicker" name="from" value="<?php echo $from;?>">
									/
									<input class="datepicker dashboard_datepicker" name="to" value="<?php echo $to;?>">
								</span>
								</form>
							</div>
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


	<!-- Modal -->
	<div class="modal fade" id="reportBug" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title" id="myModalLabel"><?php __("Report a Bug")?></h3>
	      </div>
	      <div class="modal-body">
	       	<p>Estamos trabajando continuamente para mejorar Siso, con tu ayuda lo lograremos más rápido.</p>
	       	<form>
	       		<div class="row">
	       			<div class="col-md-3">
	       				<div class="form-group">
	       					<label>Modulo</label>
	       					<select class="form-control">
	       						<option>Ventas</option>
	       					</select>
	       				</div>
	       			</div>
	       			<div class="col-md-9">
	       				<div class="form-group">
	       					<label>Descripción</label>
	       					<textarea class="form-control"></textarea>
	       				</div>
	       			</div>
	       		</div>
	       	</form>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Enviar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="report_bug"  data-toggle="modal" data-target="#reportBug" title="<?php echo __("Report a Bug", true) ?>" data-original-title="<?php echo __("Report a Bug", true) ?>" data-placement="top"><span class="glyphicon glyphicon-pushpin"></span>

	<!-- Modal HTML -->
    <div id="report_bug" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- <iframe src="http://www.getsiso.com/listar-documentos/"></iframe> -->
            </div>
        </div>
    </div>

</div>

	<!-- <div id="sql_dump"><?php echo $this->element('sql_dump'); ?></div> -->
</body>



<script type="text/javascript">
	var  url = '';
	$('.dashboard_datepicker').change(function(){
		url = '?'+$('form#filter').serialize();
		ChangeUrl(url);
		window.location.href = url;
	});

	$(document).ready(function(){
		$('.glyphicon.glyphicon-dashboard').attr('data-toggle','tooltip'); 
		$('.glyphicon.glyphicon-dashboard').attr('title','<?php echo __("Dashboard", true)?>'); 
		$('.glyphicon.glyphicon-dashboard').attr('data-original-title','<?php echo __("Dashboard", true)?>');
		$('.glyphicon.glyphicon-dashboard').attr('data-placement','bottom');
	});

</script>

<script>

<?php $user = $session->read("User"); ?>

window.intercomSettings = {
	app_id: "mcvuc25i",
	name: '<?php echo $this->Session->read('User.name'); ?>', // Full name
	email:'<?php echo $this->Session->read('User.email'); ?>', // Email address
	created_at: '<?php echo strtotime(date('Y-m-d H:i:s')); ?>' // Signup date as a Unix timestamp
};

</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/mcvuc25i';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>