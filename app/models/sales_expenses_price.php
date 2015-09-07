<?php
class SalesExpensesPrice extends AppModel {
	var $name = 'SalesExpensesPrice';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'SalesExpense' => array(
			'className' => 'SalesExpense',
			'foreignKey' => 'sales_expense_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tax' => array(
			'className' => 'Tax',
			'foreignKey' => 'tax_id',
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

	function afterSave(){
		$query = "UPDATE sales set amount = (select sum(price) from sales_expenses_prices where sales_expense_id in (select id from sales_expenses where sales_expenses.sale_id = sales.id));";
		$this->log($query, 'sales_expenses');
		$this->query($query);
	}
}
