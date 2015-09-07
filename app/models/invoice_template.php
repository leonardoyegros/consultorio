<?php
class InvoiceTemplate extends AppModel {
	var $name = 'InvoiceTemplate';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		// 'Document' => array(
		// 	'className' => 'Document',
		// 	'foreignKey' => 'document_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
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

	var $hasMany = array(
		'InvoiceTemplateElement' => array(
			'className' => 'InvoiceTemplateElement',
			'foreignKey' => 'invoice_template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
