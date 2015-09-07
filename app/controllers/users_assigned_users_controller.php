<?php
class UsersAssignedUsersController extends AppController {

	var $name = 'UsersAssignedUsers';

	function index() {
		$this->UsersAssignedUser->recursive = 0;
		$this->set('usersAssignedUsers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid users assigned user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usersAssignedUser', $this->UsersAssignedUser->read(null, $id));

		$this->sidebar->name = 'usersAssignedUser';
		$this->sidebar->data = $this->UsersAssignedUser->read(null, $id);

	}

	function add() {
		if (!empty($this->data)) {
			$this->UsersAssignedUser->create();
			if ($this->UsersAssignedUser->save($this->data)) {
				$this->Session->setFlash(__('The users assigned user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users assigned user could not be saved. Please, try again.', true));
			}
		}
		$assignedUsers = $this->UsersAssignedUser->AssignedUser->find('list');
		$users = $this->UsersAssignedUser->User->find('list');
		$this->set(compact('assignedUsers', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid users assigned user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersAssignedUser->save($this->data)) {
				$this->Session->setFlash(__('The users assigned user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users assigned user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersAssignedUser->read(null, $id);
		}
		$assignedUsers = $this->UsersAssignedUser->AssignedUser->find('list');
		$users = $this->UsersAssignedUser->User->find('list');
		$this->set(compact('assignedUsers', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for users assigned user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsersAssignedUser->delete($id)) {
			$this->Session->setFlash(__('Users assigned user deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Users assigned user was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
