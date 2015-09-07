<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {

	// function beforeSave($options = array()) {

	// 	if($this->alias != 'User'){
	// 		if (!class_exists('CakeSession'))
	// 			App::import('Core', 'Session');
	// 		$session = new CakeSession;
	// 		$userId = $session->read('User.id');

	// 		// $userId = 1;

	// 		foreach ($this->data as $key => $value) {
	// 			$this->data[$key]['user_id'] = $userId;
	// 			// print_r($this->data); die();
	// 		}
	// 	}
	//     return true;
	// }

	function beforeSaveAll($options = array()) {

		if($this->alias != 'User'){
			if (!class_exists('CakeSession'))
				App::import('Core', 'Session');
			$session = new CakeSession;
			$userId = $session->read('User.id');

			foreach ($this->data as $key => $value) {

				$this->data[$key]['created_user_id'] = $userId;
				$this->data[$key]['user_id'] = $userId;

				$alter_user = $session->read('alter_user');

				if(!empty($alter_user)){
					$this->data[$key]['created_user_id'] = $userId;
					$this->data[$key]['user_id'] = $alter_user;
				}
			}

			// print_r($this->data); die();
		}
	    return true;
	}

	function beforeSave($options = array()) {

		if($this->alias != 'User'){
			if (!class_exists('CakeSession'))
				App::import('Core', 'Session');
			$session = new CakeSession;
			$userId = $session->read('User.id');

			foreach ($this->data as $key => $value) {

				$this->data[$key]['created_user_id'] = $userId;
				$this->data[$key]['user_id'] = $userId;

				$alter_user = $session->read('alter_user');

				if(!empty($alter_user)){
					// die("alter");
					$this->data[$key]['created_user_id'] = $userId;
					$this->data[$key]['user_id'] = $alter_user;

				}
			}

			// print_r($this->data); die();
		}
	    return true;
	}



	

	function beforeFind($queryData){
		if (!class_exists('CakeSession'))
			App::import('Core', 'Session');

		$session = new CakeSession;
		$userId = $session->read('User.id');
		
		if(!empty($userId)){
			if($this->alias != 'Country' && $this->alias!='City' && $this->alias != 'User'){
					
				$alter_user = $session->read('alter_user');

				if(!empty($alter_user)){
					$userId = $alter_user;
				}
				// $userId = 1;

				$queryData['conditions'][$this->alias.".user_id"] = $userId;
			}
			
		}

		// if($this->alias == 'Currency'){
		// 	unset($queryData['conditions'][$this->alias.".user_id"]);
		// }			

		if($this->alias == 'User'){
			unset($queryData['conditions'][$this->alias.".user_id"]);
		}
		// print_r($queryData); die();
		return $queryData;
		
	}
}
