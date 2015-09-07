<?php
class PurchasesFundAccount extends AppModel {
	var $name = 'PurchasesFundAccount';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FundAccount' => array(
			'className' => 'FundAccount',
			'foreignKey' => 'fund_account_id',
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
