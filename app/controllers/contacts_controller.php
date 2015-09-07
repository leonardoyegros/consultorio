<?php
class ContactsController extends AppController {

	var $name = 'Contacts';
	var $paginate = array(
        'order' => array(
            'Contact.name' => 'asc'
        ),
        'limit' => 1000
    );

	function index() {
		$this->Contact->recursive = 0;

		$this->set('contacts', $this->paginate());
		$this->navbar = array(
			__('Contacts', true) => array('controller'=>'contacts', 'action'=>'index')
		);

		// $name = 'contacts';
		// $this->set(compact('name'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid contact', true));
			$this->redirect(array('action' => 'index'));
		}

		$options = array(
			'contain' => array(
				'ContactsExpense'=>array(
					'Expense'
				),
				'Country',
				'Currency',
				'CreatedUser'
			),
			'conditions' => array(
				'Contact.id' => $id
			)
		);

		$this->Contact->Behaviors->attach('Containable');
		$this->set('contact',$this->Contact->find('first', $options));

		$this->topbar->name = 'contact';
		$this->topbar->data = $this->Contact->read(null, $id);

		$this->navbar = array(
			__('Contacts', true) => array('controller'=>'contacts', 'action'=>'index'),
			$this->topbar->data['Contact']['name'] => array('controller'=>'contacts', 'action'=>'view',$id)
		);
	}

	function ajax_add(){

		if(!empty($_GET)){
			$this->data = $_GET['data'];
		}

		// print_r($this->data); die();

		if (!empty($this->data)) {
			$this->Contact->create();
			if ($this->Contact->save($this->data['Contact'])) {

				$contact = $this->Contact->read(null, $this->Contact->id);

				$reply = array(
					'status' => 'ok',
					'msg' => 'Contacto Guardado',
					'data' => $contact
				);	


			} else {
				$reply = array(
					'status' => 'error',
					'msg' => 'Contacto No Guardado',
					'data' => $this->data,
					'error' => $this->Contact->validationErrors
				);	
			}

			// die();
		}

		$this->renderJson($reply);
	}

	function add() {
		if (!empty($this->data)) {

			// print_r($this->data); die();

			$this->Contact->create();
			if ($this->Contact->saveAll($this->data)) {
				$this->Session->setFlash(__('The contact has been saved', true));
				$this->redirect(array('action' => 'view',$this->Contact->id));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.', true));
			}
		}
		$countries = $this->Contact->Country->find('list');
		// print_r($countries); die();
		$cities = $this->Contact->City->find('list');
		$users = $this->Contact->User->find('list');
		$currencies = $this->Contact->Currency->find('list');
		$expenses = $this->Contact->ContactsExpense->Expense->find('all', array('conditions'=>array('Expense.sales_enabled'=>true)));
		$this->set(compact('countries', 'cities', 'users', 'expenses', 'currencies'));

		$this->topbar->name = 'contact_';

		$this->navbar = array(
			__('Contacts', true) => array('controller'=>'contacts', 'action'=>'index'),
			__("Add", true) => '#'
		);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid contact', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// print_r($this->data); die();


			if(empty($this->data['Contact']['autoinvoice'])){
				$query = "DELETE FROM contacts_expenses WHERE contact_id = ".$this->data['Contact']['id'];
				// die($query);
				$this->Contact->query($query);
				$this->data['Contact']['autoinvoice'] = false;
				unset($this->data['ContactsExpense']);
			}

			if ($this->Contact->saveAll($this->data)) {


				$this->Session->setFlash(__('The contact has been saved', true));
				$this->redirect(array('action' => 'view', $this->Contact->id));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$options = array(
				'contain' => array(
					'ContactsExpense'=>array(
						'Expense'
					)
				),
				'conditions' => array(
					'Contact.id' => $id
				)
			);

			$this->Contact->Behaviors->attach('Containable');
			$this->data = $this->Contact->find('first', $options);
		}	

		// print_r($this->data); die();
		$countries = $this->Contact->Country->find('list');
		$cities = $this->Contact->City->find('list');
		$users = $this->Contact->User->find('list');
		$currencies = $this->Contact->Currency->find('list');
		$expenses = $this->Contact->ContactsExpense->Expense->find('all', array('conditions'=>array('Expense.sales_enabled'=>true)));
		$this->set(compact('countries', 'cities', 'users', 'currencies', 'expenses'));

		$this->topbar->name = 'contact';

		$this->navbar = array(
			__('Contacts', true) => array('controller'=>'contacts', 'action'=>'index'),
			__("Edit", true) => '#',
			$this->data['Contact']['name'] => array('controller'=>'contacts', 'action'=>'view', $this->data['Contact']['id'])
		);

	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for contact', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Contact->delete($id)) {
			$this->Session->setFlash(__('Contact deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Contact was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
