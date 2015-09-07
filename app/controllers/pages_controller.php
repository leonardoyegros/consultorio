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
		$this->sidebar->name = 'none';
		$this->title = 'Dashboard';
		// $this->layout = 'dashboard';

		//VENTAS
		$sales = $this->findSales();
		// salesByExpense
		$sales_total = 0;
		$total_sales_taxes = 0;
		foreach ($sales as $sale) {
			foreach ($sale['SalesExpense'] as $se) {
				foreach ($se['SalesExpensesPrice'] as $sep) {
					// print_R($sep); die();
					$salesByExpense[$se['expense_id']]['label'] = $se['Expense']['name'];
					$salesByExpense[$se['expense_id']]['y'] += $sep['price'] * $sale['Sale']['currency_price'];
					if(!empty($sep['Tax']['id'])){
						$total_sales_taxes += ($sep['price'] * $sale['Sale']['currency_price']) / ( ($sep['Tax']['rate']+100) / $sep['Tax']['rate'] );
					}
				}
			}
			$salesByTime[$sale['Sale']['issue_date']]['label'] = $sale['Sale']['issue_date'];
			$salesByTime[$sale['Sale']['issue_date']]['y'] += $sale['Sale']['amount'] * $sale['Sale']['currency_price'];
			$sales_total += $sale['Sale']['amount'] * $sale['Sale']['currency_price'];
		}

		// die();
		$this->set(compact('salesByExpense','salesByTime', 'sales_total', 'total_sales_taxes'));

		// COMPRAS
		$purchases = $this->findPurchases();
		$summaryPurchasesTaxes = $this->summaryPurchasesTaxes($purchases);
		// purchasesByExpense
		$purchases_total = 0;
		$total_purchases_taxes = 0;
		foreach ($purchases as $purchase) {
			foreach ($purchase['PurchasesExpense'] as $se) {
				foreach ($se['PurchasesExpensesPrice'] as $sep) {
					$purchasesByExpense[$se['expense_id']]['label'] = $se['Expense']['name'];
					$purchasesByExpense[$se['expense_id']]['y'] += $sep['price'] * $purchase['Purchase']['exchange_rate'];
					$total_purchases_taxes += ($sep['price'] * $purchase['Purchase']['exchange_rate']) / ( ($sep['Tax']['rate']+100) / $sep['Tax']['rate'] );
				}
			}
			$purchasesByTime[$purchase['Purchase']['invoice_date']]['label'] = $purchase['Purchase']['invoice_date'];
			$purchasesByTime[$purchase['Purchase']['invoice_date']]['y'] += $purchase['Purchase']['total'] * $purchase['Purchase']['exchange_rate'];
			$purchases_total += $purchase['Purchase']['total'] * $purchase['Purchase']['exchange_rate'];
		}
		$this->set(compact('purchasesByExpense','purchasesByTime', 'purchases_total', 'total_purchases_taxes'));

		// CUENTAS A COBRAR
		$this->set('receivables', $this->findReceivables());

		//Cuentas a pagar
		$this->set('payables', $this->findPayables());

		$this->loadModel('Currency');
		$currency = $this->Currency->find('first', array('conditions'=>array('Currency.main'=>true)));

		if(empty($currency['Currency'])){
			$this->setFlash('Please set your default Currency');
			$this->redirect(array('controller'=>'currencies', 'action' => 'add'));
			// $this->render('index_blank');
		}

		$this->set(compact('currency'));
	}

	function dashb() {
		App::import("Helper", "Format");
		$format = new FormatHelper;
		$this->sidebar->name = 'none';
		$this->title = 'Dashboard';
		$this->layout = 'dashboard';

		//VENTAS
		$sales = $this->findSales();
		// salesByExpense
		$sales_total = 0;
		$total_sales_taxes = 0;
		foreach ($sales as $sale) {
			foreach ($sale['SalesExpense'] as $se) {
				foreach ($se['SalesExpensesPrice'] as $sep) {
					// print_R($sep); die();
					$salesByExpense[$se['expense_id']]['label'] = $se['Expense']['name'];
					$salesByExpense[$se['expense_id']]['y'] += $sep['price'] * $sale['Sale']['currency_price'];
					if(!empty($sep['Tax']['id'])){
						$total_sales_taxes += ($sep['price'] * $sale['Sale']['currency_price']) / ( ($sep['Tax']['rate']+100) / $sep['Tax']['rate'] );
					}
				}
			}
			$salesByTime[$sale['Sale']['issue_date']]['label'] = $sale['Sale']['issue_date'];
			$salesByTime[$sale['Sale']['issue_date']]['y'] += $sale['Sale']['amount'] * $sale['Sale']['currency_price'];
			$sales_total += $sale['Sale']['amount'] * $sale['Sale']['currency_price'];
		}

		// die();
		$this->set(compact('salesByExpense','salesByTime', 'sales_total', 'total_sales_taxes'));

		// COMPRAS
		$purchases = $this->findPurchases();
		$summaryPurchasesTaxes = $this->summaryPurchasesTaxes($purchases);
		// purchasesByExpense
		$purchases_total = 0;
		$total_purchases_taxes = 0;
		foreach ($purchases as $purchase) {
			foreach ($purchase['PurchasesExpense'] as $se) {
				foreach ($se['PurchasesExpensesPrice'] as $sep) {
					$purchasesByExpense[$se['expense_id']]['label'] = $se['Expense']['name'];
					$purchasesByExpense[$se['expense_id']]['y'] += $sep['price'] * $purchase['Purchase']['exchange_rate'];
					$total_purchases_taxes += ($sep['price'] * $purchase['Purchase']['exchange_rate']) / ( ($sep['Tax']['rate']+100) / $sep['Tax']['rate'] );
				}
			}
			$purchasesByTime[$purchase['Purchase']['invoice_date']]['label'] = $purchase['Purchase']['invoice_date'];
			$purchasesByTime[$purchase['Purchase']['invoice_date']]['y'] += $purchase['Purchase']['total'] * $purchase['Purchase']['exchange_rate'];
			$purchases_total += $purchase['Purchase']['total'] * $purchase['Purchase']['exchange_rate'];
		}
		$this->set(compact('purchasesByExpense','purchasesByTime', 'purchases_total', 'total_purchases_taxes'));

		// CUENTAS A COBRAR
		$this->set('receivables', $this->findReceivables());

		//Cuentas a pagar
		$this->set('payables', $this->findPayables());

		$this->loadModel('Currency');
		$currency = $this->Currency->find('first', array('conditions'=>array('Currency.main'=>true)));

		if(empty($currency['Currency'])){
			$this->setFlash('Please set your default Currency');
			$this->redirect(array('controller'=>'currencies', 'action' => 'add'));
			// $this->render('index_blank');
		}

		$this->set(compact('currency'));
	}

	private function findSales(){
		// VENTAS
		$conditions = array();
		if(!empty($_GET['from'])){
			$conditions['Sale.issue_date >='] = $_GET['from'];
		}

		if(!empty($_GET['to'])){
			$conditions['Sale.issue_date <='] = $_GET['to'];
		}

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
						'Tax',
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
				'amount',
				'user_id'
			),
			'order' => array(
				'Sale.issue_date'
			)
		);

		// print_r($options); die();

		$this->loadModel('Sale');
		$this->Sale->Behaviors->attach('Containable');
		$sales = $this->Sale->find('all', $options);
		// print_R($sales);die();

		return $sales;
	}


	function ajax_delete(){

		// print_r($_GET);

		if(empty($_GET['id']) || empty($_GET['controller'])){
			$reply = array(
				'status' => 'error',
				'msg' => 'Parametros no definidos'
			);
			$this->renderJson($reply);	
		}

		$id = $_GET['id'];	
		$controller = $_GET['controller'];	

		// echo '$this->'.$controller.'->delete($id)';
		$this->loadModel($controller);

		if($controller == 'Sale' || $controller == 'Collection'){
			$data[$controller] = array(
				'id' => $id,
				'void' => true
			);

			$this->$controller->save($data);
			$reply = array(
				'status' => 'ok',
				'msg' => 'Void'
			);
		}else{
			if($this->$controller->delete($id)){
				$reply = array(
					'status' => 'ok',
					'msg' => 'Deleted'
				);
			}else{
				$reply = array(
					'status' => 'error',//,
					'msg' => 'Not Deleted',
					'errors' => $this->$controller->validationErrors
				);
			}
		}
		// print_r($reply); die();
		$this->renderJson($reply);	

	}



	private function findPurchases(){
		$conditions = array();
		if(!empty($_GET['from'])){
			$conditions['Purchase.invoice_date >='] = $_GET['from'];
		}

		if(!empty($_GET['to'])){
			$conditions['Purchase.invoice_date <='] = $_GET['to'];
		}
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
						'Tax',
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

		// print_r($purchases); die();

		return $purchases;
	}

	private function summaryPurchasesTaxes($purchases){
		// print_r($purchases); die();
	}


	private function findPayables(){
		$conditions = array();
		// if(!empty($_GET['from'])){
		// 	$conditions['Payable.overdue_date >='] = $_GET['from'];
		// }

		// if(!empty($_GET['to'])){
		// 	$conditions['Payable.overdue_date <='] = $_GET['to'];
		// }
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
			'limit' => 5
		);

		$this->loadModel('Payable');
		$this->Payable->Behaviors->attach('Containable');
		return $payables = $this->Payable->find('all', $options);
	}

	private function findReceivables(){
		$options = array(
			'conditions' => $conditions,
			'contain' => array(
				// 'Purchase',
				'Contact' => array(
					'fields' => array(
						'name'
					)
				),
				'Sale'=>array(
					'fields' =>array(
						'amount',
						'currency_price',
						'id'
					)
				),
				'Currency'
			),
			'limit' => 5
		);

		$this->loadModel('Receivable');
		$this->Receivable->Behaviors->attach('Containable');
		return $receivables = $this->Receivable->find('all', $options);
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
