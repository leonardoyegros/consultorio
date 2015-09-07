<?php
class ExpensesTax extends AppModel {
	var $name = 'ExpensesTax';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tax' => array(
			'className' => 'Tax',
			'foreignKey' => 'tax_id',
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
		'CreatedUser' => array(
			'className' => 'User',
			'foreignKey' => 'created_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
