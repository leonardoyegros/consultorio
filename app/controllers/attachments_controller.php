<?php
class AttachmentsController extends AppController {

	var $name = 'Attachments';

	function index() {
		$options = array(
			'conditions' => array(
				'Attachment.attached' => false
			)
		);

		$attachments = $this->Attachment->find('all', $options);
		$this->set(compact('attachments'));

		$this->navbar = array(
			__('Attachments', true) => array('controller'=>'attachments', 'action'=>'index')
		);
	}


	function ajax_upload($id = null) {
		if (!empty($_FILES)) {
			// print_r($_FILES);die();
			// die();
			if(!empty($_FILES['file'])){
				$_FILES[0] = $_FILES['file'];
				unset($_FILES['file']);
			}
			
			$path = $this->createUploadDir();
			$split = explode('.', $_FILES[0]['name']);
			$n2 =  md5($_FILES[0]['name']).".".$split[1]; 	
			$name = $n2;
			$i = 0;
			while (file_exists($path.$name)) {
				$name = 'd'.(++$i).'_'.$n2;
			}

			$name = $_FILES[0]['name'];
			$name = str_replace(array(' ', '*'), '', $name);

			if (move_uploaded_file($_FILES[0]['tmp_name'], $path.$name)) {
				$data['Attachment'] = array(
					'id' => $id,
					'name' => $name,
					'attached' => false
				);

				if($this->Attachment->save($data)){
					$reply = array(
						'status' => 'ok',
						'code' => 200,
						'msg' => 'Subido y guardado',
						'data' => $data,
						'name' => $name
					);
					
				}else{
					$reply = array(
						'status' => 'ok',
						'code' => 200,
						'msg' => 'Subido pero no guardado',
						'path' => $path.$name,
						'name' => $name
					);
				}
			}
			else {
				if (!is_writable($path)) {
					$reply = array(
						'status' => 'error',
						'message' => "No se puede escribir en $path",
						'code' => 400
					);
				}
				else {
					$reply = array(
						'status' => 'error',
						'message' => "Error al subir el archivo, el directorio $path tiene permisos de escritura.",
						'code' => 400
					);
				}
			}

			$reply['file'] = $_FILES;

			$this->renderJson($reply);
		}
	}

	function ajax_upload2($id = null) {
		if (!empty($_FILES)) {


			// print_r($_FILES);die();
			// die();
			$path = $this->createUploadDir();
			$split = explode('.', $_FILES[0]['name']);
			$n2 =  md5($_FILES[0]['name']).".".$split[1]; 	
			$name = $n2;
			$i = 0;
			while (file_exists($path.$name)) {
				$name = 'd'.(++$i).'_'.$n2;
			}

			$name = $_FILES[0]['name'];
			$name = str_replace(array(' ', '*'), '', $name);

			if (move_uploaded_file($_FILES[0]['tmp_name'], $path.$name)) {
				$data['Attachment'] = array(
					'id' => $id,
					'name' => $name,
					'attached' => false
				);

				if($this->Attachment->save($data)){
					$reply = array(
						'status' => 'ok',
						'code' => 200,
						'msg' => 'Subido y guardado',
						'data' => $data,
						'name' => $name
					);
					
				}else{
					$reply = array(
						'status' => 'ok',
						'code' => 200,
						'msg' => 'Subido pero no guardado',
						'path' => $path.$name,
						'name' => $name
					);
				}
			}
			else {
				if (!is_writable($path)) {
					$reply = array(
						'status' => 'error',
						'message' => "No se puede escribir en $path",
						'code' => 400
					);
				}
				else {
					$reply = array(
						'status' => 'error',
						'message' => "Error al subir el archivo, el directorio $path tiene permisos de escritura.",
						'code' => 400
					);
				}
			}

			$reply['file'] = $_FILES;

			$this->renderJson($reply);
		}
	}



	function ajax_delete(){
		$id = $_POST['id'];
		if($this->delete($id)){
			$reply = array(
				'status' => 'ok',
				'message' => "se pudo borar",
				'code' => 400
			);
		}else{
			$reply = array(
				'status' => 'error',
				'message' => "No se pudo borrar",
				'code' => 400
			);
		}

		
	}






	

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));

		$this->sidebar->name = 'attachment';
		$this->sidebar->data = $this->Attachment->read(null, $id);

	}




	function add() {
		if (!empty($this->data)) {
			$this->Attachment->create();
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The attachment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Attachment->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The attachment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attachment->read(null, $id);
		}
		$users = $this->Attachment->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attachment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attachment->delete($id)) {
			$this->Session->setFlash(__('Attachment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attachment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
