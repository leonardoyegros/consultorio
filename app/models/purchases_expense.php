<?php
class PurchasesExpense extends AppModel {
	var $name = 'PurchasesExpense';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Purchase' => array(
			'className' => 'Purchase',
			'foreignKey' => 'purchase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Expense' => array(
			'className' => 'Expense',
			'foreignKey' => 'expense_id',
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
		'PurchasesExpensesPrice' => array(
			'className' => 'PurchasesExpensesPrice',
			'foreignKey' => 'purchases_expense_id',
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
