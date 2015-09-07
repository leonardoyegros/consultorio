
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="http://www.getsiso.com/wp-content/themes/startuply/images/favicon2.ico">
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Consultorio | '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		// echo $html->meta('icon');
		// echo $html->css('cake.generic');

		//tablas
		// echo $html->css('jq');
		echo $html->css('theme.default.min');

		echo $html->css('bootstrap.min');
		echo $html->css('bootstrap-select');
		echo $html->css('bootstrap-datepicker');
		echo $html->css('chosen.min');
		echo $html->css('hr');


		echo $javascript->link('jquery.min');
		echo $javascript->link('bootstrap.min');
		echo $javascript->link('tooltip');
			

		echo $javascript->link('bootstrap-select');
		// echo $javascript->link('bootstrap-notify.min');
		echo $javascript->link('button');
		echo $javascript->link('bootstrap-datepicker');
		echo $javascript->link('bootstrap-datepicker.min');

		//tablas
		echo $javascript->link('jquery.tablesorter.min');
		echo $javascript->link('jquery.tablesorter.widgets.min');
			

		echo $javascript->link("bootstrap-notify.min");
		echo $javascript->link("chosen.jquery.min");

		// echo $javascript->link('hashtable');
		// echo $javascript->link('jquery.numberformatter-1.2.4.min');			

		echo $javascript->link('numeral.min');
		echo $javascript->link('languages.min');

		echo $javascript->link('hr');

		// echo $javascript->link('myValidator');
		echo $this->element('js/livesearch');
		echo $this->element('js/myValidator');
		

		// echo $scripts_for_layout;
	?>
</head>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table_options a').attr('data-toggle','tooltip');
		$('a[icon=plus]').attr('data-original-title', '<?php echo __('Add',true);?>');
		$('a[icon=pencil]').attr('data-original-title', '<?php echo __('Edit',true);?>');
		$('a[icon=remove]').attr('data-original-title', '<?php echo __('Remove',true);?>');
		$('a[icon=search]').attr('data-original-title', '<?php echo __('Search',true);?>');
		$('a[icon=question-sign]').attr('data-original-title', '<?php echo __('Help',true);?>');
		$('a.delete-multiple-index').attr('data-original-title', '<?php echo __('Delete Selected Items',true);?>');
	});

</script>



<body>
	<?php //echo $this->element('topmenu');?>

	<div class="container-fluid">
		<div class="row">
			<!-- SIDEBAR -->
			
			<div id="sidebar">
	           	<a id="myAccountMenu" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
	                <?php 
	                  $masters = $this->Session->read('UsersAssignedUser');
	                  // print_r($masters); die();
	                  $username = $this->Session->read('User.name');
	                  $username = split(' ', $username);                  
	                  $image = $this->Session->read('User.image');
	                  if($image != ''){
	                    $image = $this->Html->url('/')."upload/".$image;
	                  }else{
	                    $image = $this->Html->url('/')."img/default.jpg";
	                  }
	                ?>
	                <?php 
	                  $masters = $session->read('MasterUser');
	                  $masters_selected = $session->read('MasterUserSelected.User.name');
	                  $alter_user = $session->read('alter_user');
	                  if(empty($alter_user)){
	                    $msg = (!empty($username[0])?  __("Hi", true)." ".$username[0] : "Set your settings here!");
	                  }else{
	                    $masters_selected = split(' ', $masters_selected);
	                    $msg = __("Viewing as ", true).$masters_selected[0];
	                  }

	                ?>	                
	                
	                <img src="<?php echo $image?>?>" id="profile-image" class="img-circle" width="40" height="40" />
	                <span id="welcome"><?php __("Welcome")?></span>
	                <span id="username"><?php echo $msg;?></span>
				</a>
	          </div>

			<!-- CONTENIDO-->
			<div id="col-content">
				<div class="">
					<?php if ($session->check('Message.flash')): echo $session->flash(); endif; ?>					
				</div>
				<?php echo $this->element('navbar'); ?>												       
		        <div id="content">
		        	<?php echo $content_for_layout; ?>
		        </div>
		    </div>
		    <div id="filter-content">
		    	<?php ?>
		    </div>

		    <!-- Modal -->
			<div class="modal fade  bs-example-modal-m" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-m">
			    <div class="modal-content">
			      <div class="modal-body">

			      </div>
			    </div>
			  </div>
			</div>

	    </div>
	</div>	

	<!-- Modal HTML -->
    <div id="helpModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <iframe src="http://www.getsiso.com/listar-documentos/"></iframe> -->
            </div>
        </div>
    </div>
    <style type="text/css">
    	iframe{
    		width: 100%;
    		height: 500px;
    	}
    </style>

	
</body>



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

<script type="text/javascript">
	setTimeout('bindIndexTables()', 1000);
</script>	