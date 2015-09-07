<?php
class CurrenciesController extends AppController {

	var $name = 'Currencies';

	function index() {
		$this->Currency->recursive = 0;
		$this->set('currencies', $this->paginate());

		$this->navbar = array(
			__('Currencies', true) => array('controller'=>'currencies', 'action'=>'index')
		);

		$this->topbar->name = 'currencies';

	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid currency', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('currency', $this->Currency->read(null, $id));

		$this->topbar->name = 'currency';
		$this->topbar->data = $this->Currency->read(null, $id);

		$this->navbar = array(
			__('Currencies', true) => array('controller'=>'currencies', 'action'=>'index'),
			$this->topbar->data['Currency']['name'] => '#'
		);

	}

	function add() {
		if (!empty($this->data)) {

			if(empty($this->data['Currency']['main'])){
				$this->data['Currency']['main'] = false;
				$this->data['Currency']['default'] = false;
			}else{
				$this->data['Currency']['main'] = true;
				$this->data['Currency']['default'] = true;
			}

			$this->Currency->create();
			if ($this->Currency->save($this->data)) {
				$this->Session->setFlash(__('The currency has been saved', true));
				$this->redirect(array('action' => 'view', $this->Currency->id));
			} else {
				$this->Session->setFlash(__('The currency could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Currency->User->find('list');
		$this->set(compact('users'));
		
		$this->topbar->name = 'currency_';
		$this->navbar = array(
			__('Currencies', true) => array('controller'=>'currencies', 'action'=>'index'),
			__('Add', true) => '#'
		);
	}


	function ajax_view(){
		$this->Currency->recursive = -1;
		$currency = $this->Currency->read(null, $_GET['id']);
		$reply =array(
			'data' => $currency,
			'status' => 'ok'
		);
		// print_r($reply); die();
		$this->renderJson($reply);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid currency', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {

			if(empty($this->data['Currency']['main'])){
				$this->data['Currency']['main'] = false;
				$this->data['Currency']['default'] = false;
			}else{
				$this->data['Currency']['main'] = true;
				$this->data['Currency']['default'] = true;
			}

			// print_R($this->data); die();
			if ($this->Currency->save($this->data)) {
				$this->Session->setFlash(__('The currency has been saved', true));
				$this->redirect(array('action' => 'view', $this->data['Currency']['id']));
			} else {
				$this->Session->setFlash(__('The currency could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Currency->read(null, $id);
		}
		$users = $this->Currency->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for currency', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Currency->delete($id)) {
			$this->Session->setFlash(__('Currency deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Currency was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
