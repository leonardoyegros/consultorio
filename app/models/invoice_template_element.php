<?php
class InvoiceTemplateElement extends AppModel {
	var $name = 'InvoiceTemplateElement';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'InvoiceTemplate' => array(
			'className' => 'InvoiceTemplate',
			'foreignKey' => 'invoice_template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CreatedUser' => array(
			'className' => 'User',
			'foreignKey' => 'created_user_id',
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
		)
	);
}
