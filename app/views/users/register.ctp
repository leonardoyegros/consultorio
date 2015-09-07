<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-startup-image" href="/startup.png">
	<?php echo $html->charset(); ?>
	<title>
		SISO |
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		
		// echo $this->Html->css('cake.generic');
		
		// echo $this->fetch('meta');
		// echo $this->fetch('css');
		// echo $this->fetch('script');
		// echo $this->fetch('img');

		echo $html->meta('icon');

		//HR		
		echo $html->css('bootstrap.min.css');
		echo $html->css('bootstrap-select.css');
		echo $html->css('hr.css');

		
	?>
</head>
<body>
	<div class="row" id="topmessage">
		<div class="">
		<?php //echo $session->flash(); ?>
		<?php if ($session->check('Message.flash')): echo $session->flash(); endif; ?>
		</div>
	</div>

	
	<div class="container-fluid">
		

		<div class="row">
			<div class="form-container">
				<div class="well">
					<form method="post">
						<fieldset>
							<legend><?php __("Sign up!")?></legend>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group has-feedback">
									  <label class="control-label" for="inputSuccess2"><?php __("Email")?></label>
									  <input type="text" name="data[User][email]" autocomplete="false" placeholder="<?php echo __("Enter a valid E-mail");?>"  class="form-control not-empty email" id="inputSuccess2" aria-describedby="inputSuccess2Status">
									  
									</div>
									<!-- <div class="form-group">
										<label for="ContactAddress">E-mail</label>
										<input  placeholder="User" required="required" type="text" cols="4" class="form-control" id="UserLogin">
									</div> -->
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group has-feedback">
										<label for="ContactAddress">Password</label>
										<input name="data[User][password]" placeholder="Password" min="8" max="16" type="password" cols="12" class="form-control not-empty password" id="UserPassword">
									</div>
								</div>
							</div>

							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<?php //echo $this->Html->link('Register',array('controller'=>'users', 'action'=>'register'), array('class'=>'btn btn-info col-md-12'));?>
										<input type="submit" class="btn btn-primary col-md-12" value="<?php echo __("Sign Up", true);?>"> 
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Html->link('Login',array('controller'=>'users', 'action'=>'login'), array('class'=>'btn btn-info col-md-12'));?>
										<!-- <input type="submit" class="btn btn-info col-md-12" value="Register">  -->
									</div>
								</div>
							</div>


							

							<br/>

							<div class="row">
								<div class="col-md-12">
									
									<p><?php echo $this->Html->link(__('Forgot your Password?',true),array('controller'=>'users', 'action'=>'forgot_password'));?></p>
								</div>
							</div>
							
						</fieldset>
					</form>
				</div>
			</div>
	    </div>
	</div>
</body>



</html>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
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
			

		echo $javascript->link('alert');
		echo $javascript->link('bootstrap-select');
		echo $javascript->link('button');
		echo $javascript->link('bootstrap-datepicker');
		echo $javascript->link('bootstrap-datepicker.min');	


		echo $javascript->link('hr');

		// echo $scripts_for_layout;
	?>

<script type="text/javascript">
	$('form').submit(function(){
		// $('#flashMessage').hide();

		// if(!validateForm()){
		// 	return false;
		// }

		// console.log("Ok")
		// return true;

	});

	function validateForm(){
		
		if(!validateEmail($('#UserLogin').val())){
			displayAlert('<?php echo __("Enter a valid E-mail", true)?>', 'error');
			return false;
		}

		//password
		var pass = $('#UserPassword').val();
		//cantidad de caracteres
		if(pass.length < 8){
			displayAlert('<?php echo __("The password must have at least 8 digits", true)?>', 'error');
			return false;
		}

		re = /[a-z]/;
		if(!re.test(pass)) {
			displayAlert('<?php echo __("Error: password must contain at least one lowercase letter (a-z)!", true)?>', 'error');
			return false;
		}

		re = /[A-Z]/;
		if(!re.test(pass)) {
			displayAlert('<?php echo __("Error: password must contain at least one uppercase letter (A-Z)!", true)?>', 'error');
			return false;
		}

		return true;		
	}

</script>


<style type="text/css">
	input[type=checkbox], input[type=radio] {
	  max-width: 20px !important;
	  margin-top: 10px;
	  margin-right: 0;
	  display: inline-block;
	}
</style>

<?php echo $javascript->link("bootstrap-notify.min"); echo $this->element('js/myValidator');?>