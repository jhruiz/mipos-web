<?php
App::uses('AppController', 'Controller');
/**
 * Regimenes Controller
 *
 * @property Regimene $Regimene
 * @property PaginatorComponent $Paginator
 */
class RegimenesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Regimene->recursive = 0;
		$this->set('regimenes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Regimene->exists($id)) {
			throw new NotFoundException(__('el régimen no existe.'));
		}
		$options = array('conditions' => array('Regimene.' . $this->Regimene->primaryKey => $id));
		$this->set('regimene', $this->Regimene->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Regimene->create();
			if ($this->Regimene->save($this->request->data)) {
				$this->Session->setFlash(__('El régimen ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El régimen no pudo ser guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Regimene->exists($id)) {
			throw new NotFoundException(__('El régimen no existe.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Regimene->save($this->request->data)) {
				$this->Session->setFlash(__('El régimen ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El régimen no pudo ser guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Regimene.' . $this->Regimene->primaryKey => $id));
			$this->request->data = $this->Regimene->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Regimene->id = $id;
		if (!$this->Regimene->exists()) {
			throw new NotFoundException(__('El régimen no existe.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Regimene->delete()) {
			$this->Session->setFlash(__('El régimen ha sido eliminado.'));
		} else {
			$this->Session->setFlash(__('El régimen no ha sido eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
