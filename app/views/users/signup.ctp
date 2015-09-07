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
							<legend><?php echo __("Sign Up", true);?></legend>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="ContactAddress">Name</label>
										<input name="data[User][name]" placeholder="Please enter your full name" required="required" type="text" cols="4" class="form-control" id="UserLogin">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="ContactAddress">Email</label>
										<input name="data[User][email]" placeholder="Enter your E-mail address" required="required" type="email" cols="12" class="form-control" id="UserPassword">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="ContactAddress">Password</label>
										<input name="data[User][password]" placeholder="Password" required="required" type="password" cols="12" class="form-control" id="UserPassword">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="ContactAddress">Confirm Password</label>
										<input placeholder="Confirm your Password" required="required" type="password" cols="12" class="form-control" id="UserConfirmPassword">
									</div>
								</div>
							</div>
							<div class="row">
								

								<div class="col-md-3">
						          <div class="form-group">
						            <label for="basic" class="control-label">Country</label>
						                <select id="basic" name="data[User][country_id]" class="selectpicker show-tick form-control" data-live-search="true">
						                
						                  <!-- <option class="get-class" disabled>ox</option> -->
						                  <!-- <optgroup label="PRueba" data-subtext="another test"> -->
						                  <?php foreach ($countries as $key => $country) {?>
						                   <option value="<?php echo $key;?>"><?php echo $country; ?></option>
						                  <?php } ?>
						                  <!-- </optgroup> -->
						                </select>
						          </div>
						        </div>

						        <div class="col-md-3">
						          <div class="form-group">
						            <label for="basic" class="control-label">City</label>
						                <select id="basic" name="data[User][city_id]" class="selectpicker show-tick form-control" data-live-search="true">
						                
						                  <!-- <option class="get-class" disabled>ox</option> -->
						                  <!-- <optgroup label="PRueba" data-subtext="another test"> -->
						                  <?php foreach ($cities as $key => $city) {?>
						                   <option value="<?php echo $key;?>"><?php echo $city; ?></option>
						                  <?php } ?>
						                  <!-- </optgroup> -->
						                </select>
						          </div>
						        </div>

						        <div class="col-md-3">
						          <div class="form-group">
						            <label for="basic" class="control-label"><?php echo __('Language')?></label>
						                <select id="basic" name="data[User][lang]" class="selectpicker show-tick form-control" data-live-search="true">
						                	<option value="eng">English</option>	
						                	<option value="esp">Español</option>	
						                	<option value="ita">Italiano</option>						                 
						                </select>
						          </div>
						        </div>
								
							</div>
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
										<?php //echo $this->Html->link('Register',array('controller'=>'users', 'action'=>'register'), array('class'=>'btn btn-info col-md-12'));?>
										<input type="submit" class="btn btn-info col-md-12" value="<?php echo __("Sign Up", true);?>"> 
									</div>
								</div>
							</div>

							<br/>

							<div class="row">
								<div class="col-md-12">
									<p><a href=""><?php __("Forgot your password?", true)?></a></p>
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
	echo $this->Html->script('jquery.min');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('tooltip');
	echo $this->Html->script('bootstrap-select');

	echo $this->Html->script('hr');	
	


?>


<style type="text/css">
	input[type=checkbox], input[type=radio] {
	  max-width: 20px !important;
	  margin-top: 10px;
	  margin-right: 0;
	  display: inline-block;
	}
</style>