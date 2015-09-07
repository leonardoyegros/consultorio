<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/1.3/en/The-Manual/Developing-with-CakePHP/Controllers.html#the-app-controller
 */
class AppController extends Controller {
	// var $helpers = array('Format', 'Html', 'Javascript', 'Time', 'Session');
	var $helpers = array('Format','Form', 'Html', 'Javascript', 'Time', 'Session');

	// var $helpers = array("Html", "Javascript", "Mt", "Session", "Form", "Html5");
	// var $helpers = array( "Session", "Form", "Format", "Js");
	// var $helpers = array("Html", "Javascript", "Mt", "Session", "Form", "Format");
	// var $components = array("Session", "Perms", "Permissions", "Cookie");
	// var $components = array("Session", "Perms", "Permissions", "Cookie");
	var $components = array("Session", "Cookie");
	var $sidebar = null; // (object) array('name'=>null,'data'=>null,'selected'=>null);
	var $topbar = null; 
	var $limit = 100;
	var $paginate = array('limit'=>100); 
	var $cache = false;
	var $time_start = 0;
	var $time_end = 0;

	// function beforFilter(){
	// 	if(!$this->Session->check('User')){
	// 		die("asd");
	// 		$this->setFlash("Please Login.",'error');
	// 		$this->redirect("/");
	// 	}else{
	// 		die("asd");
	// 	}
	// }

	function renderJson($reply) {
		// print_r($reply);
		// die();
		$this->layout = 'json';
		$this->set(compact('reply'));
		$this->render('../pages/json_reply');
	}

	function createUploadDir() {
		Configure::load('system');
		$path = Configure::read('System.uploads.public');
		
		// Se verifica si existe el directorio
		if (!file_exists($path)) {
			mkdir($path);
		}
		return $path;
	}

	function beforeRender() {
		if ($this->Session->check('Config.language')) {
            Configure::write('Config.language', $this->Session->read('Config.language'));
        }

        // print_r($this->name);  die();

        $name = $this->name;
        $this->set(compact('name'));

		// $allowedPages = array(
		// 	'login',
		// 	'register'
		// );

		// $allowed = array_search($this->action, $allowedPages);
		if($this->action!='login' && $this->action!='register' && $this->action!='changepassword' && $this->action!='forgot_password'){
			if(!$this->Session->check('User')){
				$this->setFlash("Please Login.",'error');
				$this->redirect(array('controller'=>'users','action'=>'login'));
			}
		}

		$this->setSidebar();
		$this->setTitles();
		$this->setNavbar();
		$this->setTopbar();

		if (isset($_GET['modal'])){
			$this->layout = 'modal';
		}


		if (isset($_GET['nolayout']))
			$this->layout = 'none';
		else if (!empty($_GET['print']))
			$this->layout = 'print';
		else if (!empty($_GET['export']))
			$this->layout = 'export';
		$this->set('system', Configure::read('System'));
		$this->set('custom', Configure::read('Custom'));
		$this->set('cache', $this->cache);
	}

	function setTitles() {
		// Configure::load('system');
		// $this->pageTitle = Configure::read('System.title');
		if (!isset($this->title))
			$this->title = __($this->name, true);
		else
			$this->title = __($this->title, true);
		$this->pageTitle .= ' / ' . $this->title;
		$this->set('title1', $this->title);
		$this->set('title_for_layout', $this->title);
	}

	/**********************************************************
	 * setSidebar
	 * Define el Sidebar para la Vista
	 * ********************************************************/
	private function setSidebar() {
		// $this->sidebar = new stdClass();
		$snb = $this->Session->read('sidebar');
		if (!empty($snb)) {
			$this->sidebar = $snb;
			$this->Session->delete('sidebar');
		}
		if (!isset($this->sidebar))
			$this->sidebar = new stdClass();

		if (!isset($this->sidebar->name)) {
			$this->sidebar->name = strtolower($this->name);
		}
		$this->sidebar->selected = !isset($this->sidebar->selected) ? $this->action : $this->sidebar->selected;
		$this->set('sidebar', $this->sidebar);
	}

	private function setTopbar() {
		$snb = $this->Session->read('topbar');
		if (!empty($snb)) {
			$this->topbar = $snb;
			$this->Session->delete('topbar');
		}
		if (!isset($this->topbar))
			$this->topbar = new stdClass();

		if (!isset($this->topbar->name)) {
			$this->topbar->name = strtolower($this->name);
		}
		$this->topbar->selected = !isset($this->topbar->selected) ? $this->action : $this->topbar->selected;
		$this->set('topbar', $this->topbar);
	}


	/**********************************************************
	 * setNavbar
	 * Define el Sidebar para la Vista
	 * ********************************************************/
	private function setNavbar() {
		$snb = $this->Session->read('navbar');
		if (!empty($snb)) {
			$this->navbar = $snb;
			$this->Session->delete('navbar');
		}
		if (isset($this->navbar)) {
			$this->set('navbar', $this->navbar);
		}
	}

	/**********************************************************
	 * setFlash
	 * Define un Flash Message
	 * Entrada:
	 * 	$message 	- Mensaje a Imprimir
	 * 	$class 		- Clase CSS para el Mensaje
	 * 				  Clases Definidas: 'notice', 'message',
	 * 				                    'error'
	 * ********************************************************/
	function setFlash($message, $class = 'alert alert-success') {
		// die($class);
		if ($class=='error') {
			// die("Asdas");
			$class = 'alert alert-danger';
		}
		$this->Session->setFlash(__($message, true), 'default', array('class' => "message msg $class"));
	}

	function cache($expiration = 3600) {
		$file = CACHE."views/".md5($_SERVER['REQUEST_URI']);
		
		if (!empty($_GET['cache']) && $_GET['cache']=='no') {
			unlink($file);
			return;
		}
		
		// Se verifica si existe un cache disponible
		if (file_exists($file) && strtotime('now') - filemtime($file) < $expiration) {
			echo file_get_contents( $file );
			die();
		}
		else {
			$this->cache = true;
			ob_start();
		}
	}
	
	function loadModule($modnames) {
		$names = split(",", $modnames);
		foreach ($names as $name) {
			App::import('Model', $name);
			eval('$this->'.$name.' = new ' . $name . ';');
		}
	}
	
	function loadHelper($name) {
		App::import('Helper', $name);
		eval('$this->'.$name.' = new ' . $name . 'Helper;');
	}

	

}
