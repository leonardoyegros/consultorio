
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

		echo $html->css('theme_green');


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
	<div class="container">
	    <div class="my_row">
	        <div class="sidebar no-float">
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
	                    $msg = (!empty($username[0])?  $username[0] : "Set your settings here!");
	                  }else{
	                    $masters_selected = split(' ', $masters_selected);
	                    $msg = __("Viewing as ", true).$masters_selected[0];
	                  }

	                ?>	                
	                
	                <img src="<?php echo $image?>?>" id="profile-image" class="img-circle" width="40" height="40" />
	                <span id="welcome"><?php __("Welcome")?></span>
	                <span id="username"><?php echo $msg;?></span>
				</a>

				 <ul id="app-menu" class="nav nav-pills nav-stacked">
				  <li role="presentation" class="home active"><?php echo $this->Html->link(__('Home',true), array('controller'=>'pages', 'action'=>'index'), array('icon'=>'home'));?></li>
				  <li role="presentation" class="Users"><?php echo $this->Html->link(__('My Account',true),array('controller'=>'users', 'action'=>'my_account'), array('icon'=>'cog'));?></li>
<!-- 				  <li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				      Mi Cuenta <span class="caret"></span>
				    </a>	
				   <ul class="dropdown-menu">
			          <li><a href="#">Action</a></li>
			          <li><a href="#">Another action</a></li>
			          <li><a href="#">Something else here</a></li>
			          <li role="separator" class="divider"></li>
			          <li><a href="#">Separated link</a></li>
			        </ul>
				  </li> -->
				  <li role="presentation" class="Contacts"><?php echo $this->Html->link(__('Contacts',true),array('controller'=>'contacts', 'action'=>'index'), array('icon'=>'user'));?></li>
				  <li role="presentation" class="Appoinments"><?php echo $this->Html->link(__('Citas',true),array('controller'=>'appointments', 'action'=>'index'), array('icon'=>'calendar'));?></li>
				  <li role="presentation"><?php echo $this->Html->link(__('Mascotas',true),array('controller'=>'diets', 'action'=>'index'), array('icon'=>'list'));?></li>
				  <li role="presentation"><?php echo $this->Html->link(__('Medicamentos',true),array('controller'=>'diets', 'action'=>'index'), array('icon'=>'plus-sign'));?></li>
				</ul>

	        </div>
	        <div class="content no-float">
	        	<div class="">
					<?php if ($session->check('Message.flash')): echo $session->flash(); endif; ?>					
				</div>
				<?php echo $this->element('navbar'); ?>
				<div id="content">
					<div id="table_options">
						<?php echo $this->element('topbar/'.$topbar->name); ?>
						<div class="input-group" id="globalSearch">
					      
					      <input type="text" class="form-control" placeholder="Buscar...">
					      <span class="input-group-btn">
					        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
					      </span>
					    </div>

						<!-- <input type="text" id="globalSearch" class="form-control" placeholder="Buscar.." autocomplete="false"> -->

					</div>
		        	<?php echo $content_for_layout; ?>
		        </div>	

	        </div>
	    </div>



	</div>

	

	

	
</body>
<style type="text/css">
body{
	background-image: url('img/backgrounds/bg1.jpg');
}
html,body,.container
{
	background: #F4F4F4;
    height:100%;

}
.container
{
    display:table;
    width: 100%;
/*    margin-top: -50px;
    padding-top: 50px;*/
    /*margin-left: -15px;*/
    -moz-box-sizing: border-box;
    box-sizing: border-box;

    padding-left: 0px;
    padding-right: 0px;
}
header
{
    background: green;
    height: 50px;
}

.my_row
{
    height: 100%;
    display: table-row;
}
.sidebar.no-float, .content.no-float {
    float: none; /* thanks baxabbit */
}
.sidebar
{
    display: table-cell;
    background: #F7F7F7;
    width: 180px;
}
.content
{
	padding: 20px;
    display: table-cell;
    background: #F4F4F4;
    width: calc(80% -180px);
}

</style>

<script type="text/javascript">
	$(document).ready(function(){
		$("#app-menu li").removeClass("active");
		$("#app-menu li.<?php echo $name;?>").addClass("active");

	});
</script>