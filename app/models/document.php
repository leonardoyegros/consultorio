<?php
class Document extends AppModel {
	var $name = 'Document';
	// var $validate = array(
	// 		// 'starts_in' => array(
	//   //       'rule' => 'notEmpty',
	//   //       'message' => 'This field cannot be left blank'
 //    	// )
	// );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InvoiceTemplate' => array(
			'className' => 'InvoiceTemplate',
			'foreignKey' => 'template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	// var $hasOne = array(
	// 	'InvoiceTemplate' => array(
	// 		'className' => 'InvoiceTemplate',
	// 		'foreignKey' => 'document_id',
	// 		'dependent' => false,
	// 		'conditions' => '',
	// 		'fields' => '',
	// 		'order' => '',
	// 		'limit' => '',
	// 		'offset' => '',
	// 		'exclusive' => '',
	// 		'finderQuery' => '',
	// 		'counterQuery' => ''
	// 	)
	// );
}
