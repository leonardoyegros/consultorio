<?php
class PurchasesExpensesPrice extends AppModel {
	var $name = 'PurchasesExpensesPrice';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tax' => array(
			'className' => 'Tax',
			'foreignKey' => 'tax_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PurchasesExpense' => array(
			'className' => 'PurchasesExpense',
			'foreignKey' => 'purchases_expense_id',
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
