<?php
class Purchase extends AppModel {
	var $name = 'Purchase';
	// var $validate = array(
	// 	'contact_id' => array(
	// 		'rule' => 'validateProvider',
	// 		'message' => 'Please, enter the Provider'
	// 	)
	// 	// 'void' => array('numeric')
	// );
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
		'PurchasesAttachment' => array(
			'className' => 'PurchasesAttachment',
			'foreignKey' => 'purchase_id',
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
		'PurchasesExpense' => array(
			'className' => 'PurchasesExpense',
			'foreignKey' => 'purchase_id',
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
		'PurchasesFundAccount' => array(
			'className' => 'PurchasesFundAccount',
			'foreignKey' => 'purchase_id',
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
		'PurchasesAdvance' => array(
			'className' => 'PurchasesAdvance',
			'foreignKey' => 'purchase_id',
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
			'foreignKey' => 'purchase_id',
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

	

	function cleanAdvances(){
		// if(!empty($this->data['Purchase']))
	}


	function setPurchaseTotalPaid($id){
		$query = "UPDATE purchases SET paid = (SELECT CASE WHEN sum(amount) IS NULL THEN 0 END FROM purchases_fund_accounts WHERE purchases_fund_accounts.purchase_id = purchases.id ) + (SELECT CASE WHEN SUM(amount) IS NULL THEN 0 ELSE SUM(amount) END FROM purchases_advances WHERE purchases_advances.purchase_id = purchases.id) + (SELECT CASE WHEN SUM(amount) IS NULL THEN 0 ELSE SUM(amount) END FROM purchases_payments WHERE purchases_payments.purchase_id = purchases.id ) WHERE id = $id;
			UPDATE purchases SET paid = 0 WHERE paid IS null AND id = $id;
		";
		$this->query($query);
		$this->log($query, 'purchases');		
	}









}
