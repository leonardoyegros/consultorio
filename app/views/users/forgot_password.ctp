<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $html->charset(); ?>
	<title>
		SISO |
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		
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
			<div class="form-container" <?php if(!empty($ok)) echo 'style="display:none;"'?>>
				<div class="well">
					<form method="post">
						<fieldset>
							<legend><?php echo __("Forgot your Password?", true);?></legend>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="UserPassword">E-mail</label>
										<input name="data[User][email]" autocomplete="false"  placeholder="Enter your e-mail" required="required" type="email" cols="12" class="form-control email" id="UserLogin">
									</div>
								</div>
							</div>
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<input type="submit" class="btn btn-info col-md-12" value="<?php echo __("Send link", true);?>"> 
									</div>
								</div>
							</div>
							<br/>
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

<style type="text/css">
	input[type=checkbox], input[type=radio] {
	  max-width: 20px !important;
	  margin-top: 10px;
	  margin-right: 0;
	  display: inline-block;
	}

	.form-container{
		width: 320px;
	}

</style>

<?php echo $javascript->link("bootstrap-notify.min"); echo $this->element('js/myValidator');?>


<script type="text/javascript">

	$(document).ready(function(){

		$('#UserLogin').change(function(){
			validateForm();
		});

		$('#UserPassword').change(function(){
			validateForm();
		});

		$('form').submit(function(){
			$('#flashMessage').hide();

			if(!validateForm()){
				return false;
			}

			console.log("Ok")
		});
	});

	function validateForm(){
		
		if(!validateEmail($('#UserLogin').val())){
			displayAlert('<?php echo __("Enter a valid E-mail", true)?>', 'error');
			$('#UserLogin').focus();
			return false;
		}

		//password
		var pass = $('#UserPassword').val();
		//cantidad de caracteres
		if(pass.length < 8){
			displayAlert('<?php echo __("The password must have at least 8 digits", true)?>', 'error');
			$('#UserPassword').focus();
			return false;
		}

		re = /[a-z]/;
		if(!re.test(pass)) {
			displayAlert('<?php echo __("Error: password must contain at least one lowercase letter (a-z)!", true)?>', 'error');
			$('#UserPassword').focus();
			return false;
		}

		re = /[A-Z]/;
		if(!re.test(pass)) {
			displayAlert('<?php echo __("Error: password must contain at least one uppercase letter (A-Z)!", true)?>', 'error');
			$('#UserPassword').focus();
			return false;
		}

		return true;
		
	}




</script>

