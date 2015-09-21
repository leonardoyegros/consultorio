<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $components = array('Email');

	// function index() {

	// 	$users = $this->User->find('all');
	// 	// print_r($users); die();
	// 	$this->set(compact('users'));
		
	// }

	function list_users_admin(){
		$options = array(
			'contain' => array(

			)
		);
		$this->User->recursive = -1;
		$users = $this->User->find('all');
		// print_r($users); die();
		$this->set(compact('users'));
	}

	private function slack($message, $room = "random", $icon = ":frog:") {
        $room = ($room) ? $room : "engineering";
        $data = "payload=" . json_encode(array(
                "channel"       =>  "#{$room}",
                "text"          =>  $message,
                "icon_emoji"    =>  $icon
            ));
	
		// You can get your webhook endpoint from your Slack settings
        $ch = curl_init("https://hooks.slack.com/services/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");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function ajax_slack(){

    	$message = $_POST['message'];
    	$room = !empty($_POST['message']) ? $_POST['message'] : 'random';
    	$icon = !empty($_POST['icon']) ? $_POST['icon'] : ':monkey_face:';

    	$room = ($room) ? $room : "engineering";
        $data = "payload=" . json_encode(array(
                "channel"       =>  "#{$room}",
                "text"          =>  $message,
                "icon_emoji"    =>  $icon
            ));
	
		// You can get your webhook endpoint from your Slack settings
        $ch = curl_init("https://hooks.slack.com/services/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");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $reply = array(
        	'params' => $_POST
        );

    	$this->renderJson($reply);
    }

	// private function notify(){

	// 	$result = $this->slack("Hola Probando con cara de mono\nYes!.");
	// }

	function assign_user($id){
		$user = $this->User->read(null, $id);

		$assigned_user['UsersAssignedUser'] = array(
			'assigned_user_id' => $_GET['user'],
			'master_user_id' => $id
		);

		// print_r($assigned_user);die();
		$this->loadModel('UsersAssignedUser');
		$this->UsersAssignedUser->create();
		if(!$this->UsersAssignedUser->save($assigned_user)){
			$this->setFlash(__('User not assigned', true), 'error');
			// die("error");
		}else{
			$this->setFlash(__('We sent an invitation to your friend', true));
		}

		// die();

		$this->redirect(array('action'=>'my_account'));

	}

	function reset_password($email = null){

		if(empty($email)){
			// $this->setFlash('Email invalid', 'error');
			return;
		}


		Configure::load('email');
			$this->Email->smtpOptions = Configure::read("Email.smtpOptions");
			$this->Email->delivery = Configure::read("Email.delivery");
			$this->Email->from = Configure::read("Email.address");
			
			$this->Email->subject = "Prueba";
			$this->Email->sendAs = 'html';
			$this->Email->template = 'default';

			$this->Email->to = $email;
			$this->Email->send();
			
			// $this->redirect('/');
		
		

		// $this->Email->smtpOptions = array(
		// 	'port' => 25,
		// 	'timeout' => 30,
		// 	'host' => 'smtp.gmail.com',
		// 	'username' => 'leoomartinezyegros@gmail.com',
		// 	'password' => 'Onidonidonidonid1'
		// );

	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function ajax_index(){
		$reply = array();
		if(!empty($_GET['q'])){
			$users = $this->User->find('first', array('conditions'=>array('User.email'=>$_GET['q'])));
			if(!empty($users)){
				$reply = array(
					'data' => $users,
					'status' => 'ok'
				);
			}else{
				$reply = array(
					'q' => $_GET['q'],
					'status' => 'error'
				);
			}
		}


		$this->renderJson($reply);
	}

	function ajax_upload($id = null) {
		if (!empty($_FILES)) {
			// print_r($_POST);
			// die();
			$path = $this->createUploadDir();
			$split = explode('.', $_FILES[0]['name']);
			$n2 =  md5($_FILES[0]['name']).".".$split[1];
			$name = $n2;
			$i = 0;
			while (file_exists($path.$name)) {
				$name = 'd'.(++$i).'_'.$n2;
			}

			if (move_uploaded_file($_FILES[0]['tmp_name'], $path.$name)) {
				$reply = array(
					'status' => 'ok',
					'code' => 200,
					'data' => $path.$name,
					'name' => $name
				);
				$data['User'] = array(
					'id' => $id,
					'image' => $name
				);
				$this->Session->write('User.image', $name);
				$this->User->save($data);
			}
			else {
				if (!is_writable($path)) {
					$reply = array(
						'status' => 'error',
						'message' => "No se puede escribir en $path",
						'code' => 400
					);
				}
				else {
					$reply = array(
						'status' => 'error',
						'message' => "Error al subir el archivo, el directorio $path tiene permisos de escritura.",
						'code' => 400
					);
				}
			}

			$reply['file'] = $_FILES;

			$this->renderJson($reply);
		}
	}

	function assigned_user_enabled(){
		$id = $_GET['id'];

		$enabled = true;
		if(!empty($_GET['disable'])){
			$enabled = false;
		}

		$assigned_user['UsersAssignedUser'] = array(
			'id' => $id,
			'enabled' => $enabled
		);

		$this->loadModel('UsersAssignedUser');
		$this->UsersAssignedUser->save($assigned_user);

		$reply = array(
			'data' => $_GET,
			'status' => 'ok',
			'enabled' => $enabled,
			'assigned_user' => $assigned_user
		);

		$this->renderJson($reply);
	}

	function my_account(){
		if(!empty($this->data)){
			// print_r($this->data); die();

			if(empty($this->data['User']['password'])){
				unset($this->data['User']['password']);
			}else{
				$this->data['User']['password'] = md5($this->data['User']['password']);
			}

			

			

			if($this->User->save($this->data)){
				$user = $this->User->read(null, $this->data['User']['id']);
				$this->buildSession($user);
				$this->setFlash(__("The changes have been saved", true));
				$this->redirect(array('action'=>'my_account'));				
			}else{
				$this->setFlash(__("Error", true), 'error');
			}
		}else{

			$options = array(
				'conditions' => array(
					'User.id' => $this->Session->read('User.id')
				),
				'contain' => array(
					// 'Country',
					'City',
					// 'Expense',
					// 'Currency'
					'AssignedUser' => array( //usuarios que pueden ver su perfil
						'Assigned'
					),
					'MasterUser' => array( //usuarios que el puede ver.
						'Master'
					)
				)
			);

			$this->User->Behaviors->attach('Containable');
			$this->data = $this->User->find('first', $options);
			// print_r($this->data); die();

			// $this->data = $this->User->read(null, $this->Session->read('User.id'));
		}

		// print_r($this->data); die();
		
		
		// $this->data = $this->User->read(null, $this->User->id);
		$this->set('currencies', array(''=>__("Select", true)) + $this->User->Currency->find('list'));
		$this->set('countries', $this->User->Country->find('list'));

		$this->title = __("My Account", true);


		$this->navbar = array(
			__('My Account', true) => array('controller'=>'users', 'action'=>'my_account')
		);

		// $name = 'my_account';
		// $this->set(compact('name'));
	}

	function login() {

		
		// die("asd");
		$this->layout = 'none';	
		if(!empty($this->data) || !empty($_GET['h']) || !empty($_COOKIE['stay_logged'])){

			if(!empty($this->data['User']['email']) && !empty($this->data['User']['password'])){
				$conditions = array(
					'User.email' => $this->data['User']['email'],
					'User.password' => md5($this->data['User']['password'])
				);
			}

			// print_r($this->data); die();

			if(!empty($_GET['h'])){
				$conditions = array(
					'User.hash' => $_GET['h']
				);
			}

			if(!empty($_COOKIE['stay_logged'])){
				$conditions = array(
					'User.stay_logged_hash' => $_COOKIE['stay_logged']
				);
			}

			$this->User->log(serialize($conditions), 'users_logins');

			$options = array(
				'conditions'=>$conditions,
				'contain' => array(
					'AssignedUser' => array( //usuarios que pueden ver su perfil
						'Assigned'
					),
					'MasterUser' => array( //usuarios que el puede ver.
						'Master'
					),
					'Country',
					'City',
					'Contact',
					'Currency'
				)
			);

			$this->User->Behaviors->attach('Containable');
			$user = $this->User->find('first', $options);


			if(!empty($_GET['h'])){
				$this->activate_account($user);
			}


			// print_r($user);die();

			if(!empty($user)){
				if (!empty($_GET['ref'])) {
					header("Location: " . $_GET['ref']);
				}

				// print_r($this->data);
				if(!empty($this->data['stay_logged'])){
					$this->begginLogged($user);
				}


				
				// die();

				$this->buildSession($user);
				$this->redirect(array('controller'=>'pages', 'action'=>'index'));
				
			}else{
				$this->setFlash("User Not Fund, please try again.",'error');
			}
		}else{
			// die("Asd");
		}
	}

	private function begginLogged($user){
		// die("Asd");
		$hash = md5($user['User']['id'].date('Y-m-d H:i:s'));
		$user['User']['stay_logged_hash'] = $hash;
		if($this->User->save($user)){
			$this->User->log('stay_logged saved for User : '. $user['User']['email'], 'users_logins');
			setcookie("stay_logged", $hash, strtotime('+3600'), '/');
		}
	}

	private function endLogged(){
		$user = $this->Session->read('User');
		$user['stay_logged_hash'] = null;

		// print_r($user); 

		if(!empty($user)){
			setcookie("stay_logged", "", time() - 3600, '/');
			// die("saved");
		}else{
			// die("Not saved");
		}

	}

	function register() {

		if (!empty($this->data)) {

			// print_r($this->data); die();

			$this->data['User']['password'] = md5($this->data['User']['password']);
			$this->data['User']['hash'] = md5($this->data['User']['email'].$this->data['User']['password']);

			$this->User->log(serialize($this->data), 'users_registers');

			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->User->log('saved', 'users_registers');
				$this->Session->setFlash(__('Your now register in Siso, we sent you an email to active your account.', true));

				$options = array(
					// 'name' => $this->data['User']['name'],
					'email' => $this->data['User']['email'],
					'password' => $this->data['User']['password']
				);

				if(!empty($this->data['User']['name'])){
					$options['name'] = $this->data['User']['name'];
				}

				$this->welcome_email($options);
				

				// $this->slack("El Usuario ".$user['User']['name']." se logueo");
				$this->slack("Nuevo Usuario ".$this->data['User']['email'], 'new_users');

				$user = $this->User->read(null, $this->User->id);
				$this->buildSession($user);

				//create initials
				$this->createInitialCurrency($user['User']['id']);
				$this->createInitialFundAccount($this->User->id);


				$this->redirect(array('controller'=>'users', 'action'=>'my_account'));

			} else {
				$this->User->log('not saved', 'users_registers');
				// print_R($_POST); die();
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}


		$this->layout = 'none';	
		$this->topmenu = '';
		$this->sidebar->name = '';

		$countries = $this->User->Country->find('list');
		$cities = $this->User->City->find('list');

		$this->set(compact('countries', 'cities'));

		// die("register");
	}

	private function createInitialFundAccount($user_id){
		$this->loadModel('Currency');
		$this->loadModel('FundAccount');

		$currency = $this->Currency->find('first', array('conditions'=>array('Currency.main'=>true)));

		$fund_account = array(
			'FundAccount' => array(
				'name' => 'Default Fund Account',
				'currency_id' => $currency['Currency']['id'],
				'active' => true,
				'category' => 'cash',
				'user_id' => $user_id
			)
		);

		$this->FundAccount->create();
		if($this->FundAccount->save($fund_account)){
			$this->User->log('Cuenta de Fondo: Creadas', 'initials');
		}else{
			$this->User->log('Cuenta de Fondo: No pudo ser creada', 'initials');
		}
	}

	private function createInitialCurrency($user_id){
		$this->loadModel('Currency');
		$currencies = array(
			0 => array(
				'name' => 'Default Currency',
				'buy_price' => 1,
				'sale_price' => 1,
				'default' => true,
				'symbol' => 'USD',
				'decimals' => 2,
				'main' => true,
				'user_id' => $user_id
			)
		);

		$this->Currency->create();
		if($this->Currency->saveAll($currencies)){
			$this->User->log('Monedas: Creadas', 'initials');
		}else{
			$this->User->log('Monedas: No pudieron ser Creadas', 'initials');
		}
		
	}

	function welcome_email($options){

		//debug
		if(empty($options)){
			$options = array(
				'email' => 'leoomartinezyegros@gmail.com',
				'password' => ''
			);
		}

		Configure::load('email');
		$this->Email->smtpOptions = Configure::read("Email.smtpOptions");
		$this->Email->delivery = Configure::read("Email.delivery");
		$this->Email->from = Configure::read("Email.address");
		
		$this->Email->subject = __("Welcome to Siso", true);
		$this->Email->sendAs = 'html';
		$this->Email->template = 'welcome_email';

		$this->Email->to = $options['email'];
		$link = Configure::read("Email.server").'/users/login?h='.md5($options['email'].$options['password']);
		$this->set(compact('link'));

		$text = '
		<h2>Welcome to SISO</h2>
		<p>Hi, you are now registered to siso.</p>
		<p>You are almost there. </p>
		<p>To activate your account go to this <a href="'.$link.'">link</a></p>';

		$this->set(compact('text','link'));

		$this->Email->send();

			// die();
	}

	function forgot_password(){
		$this->layout = 'none';

		if(!empty($this->data)){

			$user = $this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['email'])));
			if(!empty($user['User'])){
				$this->sent_retrieve_pwd_email($user);
				$ok = true;
				$this->set(compact('ok'));
				$this->setFlash('Change password link already send it to your e-mail');
				$this->redirect(array('action'=>'login'));
			}else{
				$this->setFlash(__('User not fund', true), 'error');
			}

			
		}

	}

	private function sent_retrieve_pwd_email($user){

		// print_r($user); die();

		Configure::load('email');
		$this->Email->smtpOptions = Configure::read("Email.smtpOptions");
		$this->Email->delivery = Configure::read("Email.delivery");
		$this->Email->from = Configure::read("Email.address");
		
		$this->Email->subject = __("Change your Password", true);
		$this->Email->sendAs = 'html';
		// $this->Email->template = 'change_password';

		$this->Email->to = $user['User']['email'];

		$link = Configure::read("Email.server").'/users/changepassword?h='.md5($user['User']['email']);
		$this->set(compact('link'));

		$text = '
			<p>Follow this link in order to change your password</p> <a href="'.$link.'">Link</a>
		';

		if(!$this->Email->send($text)){
			// $errors = $this->Email->Errors
			die("error enviando email")	;
		}

		// die();
	}

	function changepassword(){

		// if(empty($this->data['User']['id'])){
		// 	$this->setFlash("User not found");
		// }

		if(!empty($this->data)){
			if(empty($this->data['User']['id'])){
				$this->setFlash("User not found", 'error');
			}else{

				$this->data['User']['password'] = md5($this->data['User']['password']);


				$this->User->save($this->data);
			}
			$this->User->save($this->data);
			$this->setFlash(__("Password Changed",true));
			$user = $this->User->find('first', array('conditions'=>array('User.id'=> $this->data['User']['id'])));
			$this->buildSession($user);
			$this->redirect(array('controller'=>'pages', 'action'=>'index'));
		}

		if(!empty($_GET['h'])){
			$options = array(
				'conditions'=>array(
					'md5("User".email)'=> $_GET['h']
				)
			);

			$this->data = $this->User->find('first', $options);
			// print_R($this->data);die();
		}

		$this->layout = 'none';
	}

	private function activate_account($users){
		$user['User']['activated'] = true;
		$this->User->save($user);
	}

	function add_assigned_user(){

		$user_session = $this->Session->read('User');

		// print_r($user_session); die();

		//veririficar si existe el email.
		$email = $_GET['email'];
		$user = $this->User->find('first', array('conditions'=>array('User.email'=>$email)));

		// print_r($user); die();

		if(!empty($user['User'])){
			$assigned_user['UsersAssignedUser'] = array(
				'assigned_user_id' => $user['User']['id'],
				'master_user_id' => $user_session['id']
			);
		}else{
			$user['User'] = array(
				'email' => $email,
				'password' => md5('Abc12345')
			);

			$this->User->create();
			$this->User->save($user);
			$user['User']['id'] = $this->User->id;

			$assigned_user['UsersAssignedUser'] = array(
				'assigned_user_id' => $user['User']['id'],
				'master_user_id' => $user_session['id']
			);
		}

		// print_r($assigned_user); die();

		$this->loadModel('UsersAssignedUser');
		$this->UsersAssignedUser->create();
		$this->UsersAssignedUser->save($assigned_user);

		$reply = array(
			'ok',
			'GET' => $_GET
		);

		$this->renderJson($reply);

		// $this->redirect(array('action'=>'my_account'));
	}

	function logout(){
		$this->endLogged();

		$this->Session->delete('User');
		// $this->Session->delete('Companies');
		// $this->Session->delete('AppDB');
		// unset($_SESSION['AppDB']);
		// $this->Session->delete('VoxCentre');
		unset($_SESSION['cache']);
		unset($_SESSION['alter_user']);
		unset($_SESSION['MasterUserSelected']);
		unset($_SESSION['MasterUser']);


		
		$this->redirect(array('action'=>'login'));
		// $this->redirect($this->Auth->logout());
	}

	function change_user($id = null){

		if(empty($id)){
			unset($_SESSION['alter_user']);
			$this->redirect(array('controller'=>'pages', 'action'=>'index'));
		}
		// echo $id; die();
		$options = array(
			'conditions' => array(
				'User.id' => $id
			)
		);

		// print_r($options); die();

		$MasterUserSelected = $this->User->read(null, $id);

		// print_r($MasterUserSelected); die();
		$this->Session->write('alter_user', $id);
		$this->Session->write('MasterUserSelected', $MasterUserSelected);

		if(!empty($_GET['me'])){
			unset($_SESSION['alter_user']);
		}

		// print_R($_SESSION); die();

		$this->redirect(array('controller'=>'pages', 'action'=>'index'));
	}

	function buildSession($user){
		$this->Session->write('User', $user['User']);
		$this->Session->write('MasterUser', $user['MasterUser']);
		$this->Session->write('Config.language', $user['User']['lang']);
		unset($_SESSION['cache']);

		// print_r($_SESSION); die();
	}

	function language($lang = 'eng') {
		$this->User->showAll = true;
		// $this->Cookie->write('Language', $lang);
		if ($this->Session->read('User') !== null) {
			$this->Session->write('Config.language', $lang);
			$this->Session->write('User.lang', $lang);
			$data['User']['id'] = $this->Session->read('User.id');
			$data['User']['lang'] = $lang;
			$this->User->save($data);
		}
		$this->redirect(array('controller'=>'pages', 'action'=>'index'));
	}




	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->User->Country->find('list');
		$cities = $this->User->City->find('list');
		$users = $this->User->User->find('list');
		$this->set(compact('countries', 'cities', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$countries = $this->User->Country->find('list');
		$cities = $this->User->City->find('list');
		$users = $this->User->User->find('list');
		$this->set(compact('countries', 'cities', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
