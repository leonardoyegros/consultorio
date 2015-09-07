<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/958/The-Pages-Controller
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Session', 'Format');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */

	function index() {
		App::import("Helper", "Format");
		$format = new FormatHelper;
		// die("asd");
		// $this->sidebar->name = 'shortcuts';
		$this->sidebar->name = 'none';
		$this->title = 'Dashboard';
		$this->layout = 'dashboard';
		// $this->topmenu->selected = 'none';
		
		// $user = $this->Session->read("User");
		// print_r($user);
		// die();


		// VENTAS
		$conditions = array();
		$options = array(
			'conditions' => $conditions,
			'contain' => array(
				'SalesExpense' => array(
					'Expense' =>array(
						'fields' => array(
							'Expense.name'
						)
					),
					'SalesExpensesPrice' => array(
						'fields' => array(
							'price'
						)
					),
					'fields' => array(
						'id'
					)	
				)
				
			),
			'fields' => array(
				'id',
				'currency_price',
				'issue_date',
				'amount'
			),
			'order' => array(
				'Sale.issue_date'
			)
		);
		$this->loadModel('Sale');
		$this->Sale->Behaviors->attach('Containable');
		$sales = $this->Sale->find('all', $options);

		// salesByExpense
		$sales_total = 0;
		foreach ($sales as $sale) {
			foreach ($sale['SalesExpense'] as $se) {
				foreach ($se['SalesExpensesPrice'] as $sep) {
					$salesByExpense[$se['expense_id']]['label'] = $se['Expense']['name'];
					$salesByExpense[$se['expense_id']]['y'] += $sep['price'] * $sale['Sale']['currency_price'];
				}
			}
			$salesByTime[$sale['Sale']['issue_date']]['label'] = $sale['Sale']['issue_date'];
			$salesByTime[$sale['Sale']['issue_date']]['y'] += $sale['Sale']['amount'] * $sale['Sale']['currency_price'];
			$sales_total += $sale['Sale']['amount'] * $sale['Sale']['currency_price'];
		}
		// print_r($salesByTime); die();
		$this->set(compact('salesByExpense','salesByTime', 'sales_total'));

		// COMPRAS
		$conditions = array();
		$options = array(
			'conditions' => $conditions,
			'contain' => array(
				'PurchasesExpense' => array(
					'Expense' =>array(
						'fields' => array(
							'Expense.name'
						)
					),
					'PurchasesExpensesPrice' => array(
						'fields' => array(
							'price'
						)
					),
					'fields' => array(
						'id'
					)	
				)
				
			),
			'fields' => array(
				'id',
				'exchange_rate',
				'invoice_date',
				'total'
			),
			'order' => array(
				'Purchase.invoice_date'
			)
		);
		$this->loadModel('Purchase');
		$this->Purchase->Behaviors->attach('Containable');
		$purchases = $this->Purchase->find('all', $options);

		// print_R($purchases); die();

		// purchasesByExpense
		$purchases_total = 0;
		foreach ($purchases as $purchase) {
			foreach ($purchase['PurchasesExpense'] as $se) {
				foreach ($se['PurchasesExpensesPrice'] as $sep) {
					$purchasesByExpense[$se['expense_id']]['label'] = $se['Expense']['name'];
					$purchasesByExpense[$se['expense_id']]['y'] += $sep['price'] * $purchase['Purchase']['exchange_rate'];
				}
			}
			$purchasesByTime[$purchase['Purchase']['invoice_date']]['label'] = $purchase['Purchase']['invoice_date'];
			$purchasesByTime[$purchase['Purchase']['invoice_date']]['y'] += $purchase['Purchase']['total'] * $purchase['Purchase']['exchange_rate'];
			$purchases_total += $purchase['Purchase']['total'] * $purchase['Purchase']['exchange_rate'];
		}
		// print_r($purchasesByExpense); die();
		$this->set(compact('purchasesByExpense','purchasesByTime', 'purchases_total'));


		//Cuentas a pagar

		$conditions = array();
		$options = array(
			'conditions' => $conditions,
			'contain' => array(
				// 'Purchase',
				'Contact' => array(
					'fields' => array(
						'name'
					)
				),
				'Purchase'=>array(
					'fields' =>array(
						'total',
						'exchange_rate',
						'id'
					)
				),
				'Currency'
			),
			'limit' => 3
		);

		$this->loadModel('Payable');
		$this->Payable->Behaviors->attach('Containable');
		$payables = $this->Payable->find('all', $options);
		// print_r($payables); die();
		$this->set(compact('payables'));



		$this->loadModel('Currency');
		$currency = $this->Currency->find('first', array('conditions'=>array('Currency.default'=>true)));
		$this->set(compact('currency'));
		
		if (isset($_GET['refresh'])) {
			$this->renderJson(array('status'=>'ok'));
		}
		
		// $this->layout = 'none';
	}

	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));	

	}
}
