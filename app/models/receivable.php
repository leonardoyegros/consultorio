<?php
class Receivable extends AppModel {
	var $name = 'Receivable';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Contact' => array(
			'className' => 'Contact',
			'foreignKey' => 'contact_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
