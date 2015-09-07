<?php
class SalesFundAccount extends AppModel {
	var $name = 'SalesFundAccount';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FundAccount' => array(
			'className' => 'FundAccount',
			'foreignKey' => 'fund_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'sale_id',
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
		echo $query = "UPDATE sales set amount = (select amount from sales_fund_accounts where sales_fund_accounts.sale_id = sales.id) where id =".$this->Sale->id;
		// $query = "UPDATE sales set amount = (select sum(price) from sales_expenses_prices where sales_expense_id in (select id from sales_expenses where sales_expenses.sale_id = sales.id));";

		$this->log($query, 'sales_fund_accounts');
		$this->query($query);

		// die();
	}
}
