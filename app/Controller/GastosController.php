<?php
App::uses('AppController', 'Controller');
App::uses('UsuariosController', 'Controller');
/**
 * Gastos Controller
 *
 * @property Gasto $Gasto
 * @property PaginatorComponent $Paginator
 */
class GastosController extends AppController {

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
            /*se reagistra la actividad del uso de la aplicacion*/
            $usuariosController = new UsuariosController();
            $usuarioAct = $this->Auth->user('id');
            $usuariosController->registraractividad($usuarioAct);
            		
            $empresaId = $this->Auth->user('empresa_id');
            $paginate['Gasto.empresa_id'] = $empresaId; 
            $this->Gasto->recursive = 0;
            $this->set('gastos', $this->Paginator->paginate('Gasto',$paginate));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            /*se reagistra la actividad del uso de la aplicacion*/
            $usuariosController = new UsuariosController();
            $usuarioAct = $this->Auth->user('id');
            $usuariosController->registraractividad($usuarioAct);
            		
		if (!$this->Gasto->exists($id)) {
			throw new NotFoundException(__('El gasto no existe.'));
		}
		$options = array('conditions' => array('Gasto.' . $this->Gasto->primaryKey => $id));
		$this->set('gasto', $this->Gasto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            /*se reagistra la actividad del uso de la aplicacion*/
            $usuariosController = new UsuariosController();
            $usuarioAct = $this->Auth->user('id');
            $usuariosController->registraractividad($usuarioAct);
            		
            $this->loadModel('Usuario');
            $this->loadModel('Cuenta');
            if ($this->request->is('post')) {
                $posData = $this->request->data;
                $valor = str_replace(',', '', $posData['Gasto']['valor']);
                $cuentaId = $posData['Gasto']['cuenta_id'];                
                $this->descontarSaldoCuenta($valor,$cuentaId);                
                
                 $this->request->data['Gasto']['valor'] = str_replace(',', '', $this->request->data['Gasto']['valor']);  
                
                $this->Gasto->create();
                if ($this->Gasto->save($this->request->data)) {
                        $this->Session->setFlash(__('El gasto ha sido guardado.'));
                        return $this->redirect(array('action' => 'index'));
                } else {
                        $this->Session->setFlash(__('El gasto no pudo ser guardado. Por favor, inténtelo de nuevo.'));
                }
            }

            $empresaId = $this->Auth->user('empresa_id');
            $usuarios = $this->Usuario->obtenerUsuarioEmpresa($empresaId);
            $cuentas = $this->Cuenta->obtenerCuentasEmpresa($empresaId);
            $this->set(compact('usuarios', 'empresaId', 'cuentas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            /*se reagistra la actividad del uso de la aplicacion*/
            $usuariosController = new UsuariosController();
            $usuarioAct = $this->Auth->user('id');
            $usuariosController->registraractividad($usuarioAct);
            	            		
            $this->loadModel('Usuario');
            $this->loadModel('Cuenta');
            if (!$this->Gasto->exists($id)) {
                    throw new NotFoundException(__('El gasto no existe'));
            }
            if ($this->request->is(array('post', 'put'))) {
                    if ($this->Gasto->save($this->request->data)) {
                            $this->Session->setFlash(__('El gasto ha sido guardado.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('El gasto no pudo ser guardado. Por favor, inténtelo de nuevo.'));
                    }
            } else {
                    $options = array('conditions' => array('Gasto.' . $this->Gasto->primaryKey => $id));
                    $this->request->data = $this->Gasto->find('first', $options);
            }
            $empresaId = $this->Auth->user('empresa_id');
            $usuarios = $this->Usuario->obtenerUsuarioEmpresa($empresaId);
            $cuentas = $this->Cuenta->obtenerCuentasEmpresa($empresaId);
            $this->set(compact('usuarios', 'empresaId', 'cuentas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Gasto->id = $id;
		if (!$this->Gasto->exists()) {
			throw new NotFoundException(__('El gasto no existe.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Gasto->delete()) {
			$this->Session->setFlash(__('El gasto ha sido eliminado.'));
		} else {
			$this->Session->setFlash(__('El gasto no pudo ser eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function descontarSaldoCuenta($valor,$cuentaId){
            $this->loadModel('Cuenta');
            
            //Se obtienen los datos de la cuenta por id
            $datosCuenta = $this->Cuenta->obtenerDatosCuentaId($cuentaId);
            $saldoFinal = $datosCuenta['Cuenta']['saldo'] - $valor;
            
            //Se actualiza el saldo de la cuenta
            $this->Cuenta->actualizarSaldoCuenta($cuentaId,$saldoFinal);
        }
}
