

<?php

	// Mandrill app
	// $config['Email']['address'] = 'Siso <no-reply@siso.com>';
	// $config['Email']['smtpOptions'] = array(
	// 	'port'		=>'587',
	// 	'timeout'	=>'30',
	// 	'host'		=> 'smtp.mandrillapp.com',
	// 	'username' 	=> 'leoomartinezyegros@gmail.com',
	// 	'password' 	=> 'DtQeEmB3pNCKVVb0QQCQwA'
	// );
	// $config['Email']['server'] = 'http://localhost/leo/siso13/siso1.3';	
	// $config['Email']['delivery'] = 'smtp';


	// gmail
	// $config['Email']['address'] = 'Siso <no-reply@siso.com>';
	// $config['Email']['smtpOptions'] = array(
	// 	'port'		=>'465',
	// 	'timeout'	=>'30',
	// 	'host'		=> 'ssl://smtp.gmail.com',
	// 	'username' 	=> 'sisoapppy@gmail.com',
	// 	'password' 	=> '4m1d4l4s',
	// 	'transport' => 'Smtp'
	// );
	// $config['Email']['server'] = 'http://localhost/leo/siso13/siso1.3';	
	// $config['Email']['delivery'] = 'smtp';


	// siso
	//con ssl
	// $config['Email']['address'] = 'Siso <no-reply@getsiso.com>';
	// $config['Email']['smtpOptions'] = array(
	// 	'port'		=>'465',
	// 	'timeout'	=>'30',
	// 	'host'		=> 'box1205.bluehost.com',
	// 	// 'host'		=> 'mail.getsiso.com',
	// 	'username' 	=> 'no-reply@getsiso.com',
	// 	'password' 	=> 'NBc9T6Ffd.'//,
	// 	// 'transport' => 'Smtp'
	// );
	// $config['Email']['server'] = 'http://localhost/leo/siso13/siso1.3';	
	// $config['Email']['delivery'] = 'smtp';

	//con ssl
	$config['Email']['address'] = 'Siso <no-reply@getsiso.com>';
	$config['Email']['smtpOptions'] = array(
		'port'		=>'26',
		'timeout'	=>'30',
		'host'		=> 'mail.getsiso.com',
		// 'host'		=> 'mail.getsiso.com',
		'username' 	=> 'no-reply@getsiso.com',
		'password' 	=> 'NBc9T6Ffd.'//,
		// 'transport' => 'Smtp'
	);
	$config['Email']['server'] = 'http://localhost/leo/siso13/siso1.3';	
	$config['Email']['delivery'] = 'smtp';

	
	
	
?>