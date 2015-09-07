<?php
class PaymentsFundAccount extends AppModel {
	var $name = 'PaymentsFundAccount';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FundAccount' => array(
			'className' => 'FundAccount',
			'foreignKey' => 'fund_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'payment_id',
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
