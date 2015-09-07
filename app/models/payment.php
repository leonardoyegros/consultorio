<?php
class Payment extends AppModel {
	var $name = 'Payment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Contact' => array(
			'className' => 'Contact',
			'foreignKey' => 'contact_id',
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
		'PaymentsAttachment' => array(
			'className' => 'PaymentsAttachment',
			'foreignKey' => 'payment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PurchasesPayment' => array(
			'className' => 'PurchasesPayment',
			'foreignKey' => 'payment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PaymentsFundAccount' => array(
			'className' => 'PaymentsFundAccount',
			'foreignKey' => 'payment_id',
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

	var $hasAndBelongsToMany = array(
		// 'FundAccount' => array(
		// 	'className' => 'FundAccount',
		// 	'joinTable' => 'payments_fund_accounts',
		// 	'foreignKey' => 'payment_id',
		// 	'associationForeignKey' => 'fund_account_id',
		// 	'unique' => true,
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => '',
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'finderQuery' => '',
		// 	'deleteQuery' => '',
		// 	'insertQuery' => ''
		// ),
		// 'Purchase' => array(
		// 	'className' => 'Purchase',
		// 	'joinTable' => 'purchases_payments',
		// 	'foreignKey' => 'payment_id',
		// 	'associationForeignKey' => 'purchase_id',
		// 	'unique' => true,
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => '',
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'finderQuery' => '',
		// 	'deleteQuery' => '',
		// 	'insertQuery' => ''
		// ),
		// 'PurchasesAdvance' => array(
		// 	'className' => 'PurchasesAdvance',
		// 	'joinTable' => 'purchases_advances',
		// 	'foreignKey' => 'payment_id',
		// 	'associationForeignKey' => 'purchase_id',
		// 	'unique' => true,
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => '',
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'finderQuery' => '',
		// 	'deleteQuery' => '',
		// 	'insertQuery' => ''
		// )
	);

	function setAvanceUsed(){
		$query = 'UPDATE payments SET used = (SELECT SUM(amount) FROM purchases_advances WHERE purchases_advances.payment_id = payments.id)';
		$this->log($query, 'payments');
		$this->query($query);
	}

	function afterSave(){
		// $query = "UPDATE payments SET amount = (SELECT SUM(amount) FROM payments_fund_accounts WHERE payments_fund_accounts.payment_id = payments.id) WHERE id = ".$this->data['Payment']['id'];
		// $this->query($query);
		// die("save!");
	}

}
