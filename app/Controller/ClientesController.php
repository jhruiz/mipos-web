<?php
App::uses('AppController', 'Controller');
App::uses('UsuariosController', 'Controller');
/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class ClientesController extends AppController {

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
                        
            if(isset($this->passedArgs['nit']) && $this->passedArgs['nit'] != ""){
                $paginate['LOWER(Cliente.nit) LIKE'] = '%' . strtolower($this->passedArgs['nit']) . '%';
            }            
            
            if(isset($this->passedArgs['nombre']) && $this->passedArgs['nombre'] != ""){
                $paginate['LOWER(Cliente.nombre) LIKE'] = '%' . strtolower($this->passedArgs['nombre']) . '%';
            }                        
            
            $empresaId = $this->Auth->user('empresa_id');
            $paginate['Cliente.empresa_id'] = $empresaId;            
            $this->Cliente->recursive = 0;
            $this->set('clientes', $this->Paginator->paginate('Cliente',$paginate));  
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
            	
		if (!$this->Cliente->exists($id)) {
			throw new NotFoundException(__('El cliente no existe.'));
		}
		$options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
		$this->set('cliente', $this->Cliente->find('first', $options));
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
            	
		if ($this->request->is('post')) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('El cliente ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El cliente no pudo ser guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$ciudades = $this->Cliente->Ciudade->find('list');
		$estados = $this->Cliente->Estado->find('list');		
                $empresaId = $this->Auth->user('empresa_id');
                $depositos = $this->Cliente->Deposito->obtenerDepositoEmpresa($empresaId);
                $usuarioId = $this->Auth->user('id');
		$this->set(compact('ciudades', 'usuarioId', 'estados', 'depositos', 'empresaId'));
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
            	
		if (!$this->Cliente->exists($id)) {
			throw new NotFoundException(__('El cliente no existe.'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('El cliente ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El cliente no pudo ser guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
			$this->request->data = $this->Cliente->find('first', $options);
		}
		$ciudades = $this->Cliente->Ciudade->find('list');
		$estados = $this->Cliente->Estado->find('list');
		$empresaId = $this->Auth->user('empresa_id');
		$depositos = $this->Cliente->Deposito->obtenerDepositoEmpresa($empresaId);                
                $usuarioId = $this->Auth->user('id');                
		$this->set(compact('ciudades', 'usuarioId', 'estados', 'depositos', 'empresaId'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cliente->id = $id;
		if (!$this->Cliente->exists()) {
			throw new NotFoundException(__('El cliente no existe.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cliente->delete()) {
			$this->Session->setFlash(__('El cliente ha sido eliminado.'));
		} else {
			$this->Session->setFlash(__('El cliente no pudo ser eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function ajaxObtenerClientes(){
            $this->autoRender = false;
            
            $posData = $this->request->data;
            $cliente = strtolower($posData['datosCliente']);
            $empresaId = $posData['empresaId'];
            $resp = $this->Cliente->obtenerDatosCliente($cliente,$empresaId);
            echo json_encode(array('resp' => $resp));            
        }
        
        public function ajaxObtenerInfoCliente(){
            $this->autoRender = false;            
            $posData = $this->request->data;
            $cliente = $posData['clienteId'];
            $resp = $this->Cliente->obtenerInformacionCliente($cliente);
            echo json_encode(array('resp' => $resp));               
        }
        
        public function ajaxActualizarNitCliente(){
            $this->autoRender = false;            
            $posData = $this->request->data;
            $data = array();
            $data['id'] = $posData['clienteId'];
            $data['nit'] = $posData['nit'];                    
            
            if($this->Cliente->save($data)){
                $mensaje = "Se actualiza el Nit del Cliente.";
            }else{
                $mensaje = "No se pudo actualizar el Nit del Cliente. Por favor, inténtelo de nuevo.";
            }   
            echo json_encode(array('resp' => $mensaje));             
        }
        
        public function ajaxActualizarTelCliente(){
            $this->autoRender = false;            
            $posData = $this->request->data;
            $data = array();
            $data['id'] = $posData['clienteId'];
            $data['telefono'] = $posData['telefono'];                    
            
            if($this->Cliente->save($data)){
                $mensaje = "Se actualiza el Teléfono del Cliente.";
            }else{
                $mensaje = "No se pudo actualizar el Teléfono del Cliente. Por favor, inténtelo de nuevo.";
            }   
            echo json_encode(array('resp' => $mensaje));               
        }
        
        public function ajaxActualizarDirCliente(){
            $this->autoRender = false;            
            $posData = $this->request->data;
            $data = array();
            $data['id'] = $posData['clienteId'];
            $data['direccion'] = $posData['direccion'];                    
            
            if($this->Cliente->save($data)){
                $mensaje = "Se actualiza la Dirección del Cliente.";
            }else{
                $mensaje = "No se pudo actualizar la Dirección del Cliente. Por favor, inténtelo de nuevo.";
            }   
            echo json_encode(array('resp' => $mensaje));             
        }
        
        public function ajaxActualizarDiasCliente(){
            $this->autoRender = false;            
            $posData = $this->request->data;
            $data = array();
            $data['id'] = $posData['clienteId'];
            $data['diascredito'] = $posData['diascredito'];                    
            
            if($this->Cliente->save($data)){
                $mensaje = "Se actualizan los Días de Crédito del Cliente.";
            }else{
                $mensaje = "No se pudo actualizar los Días de Crédito del Cliente. Por favor, inténtelo de nuevo.";
            }   
            echo json_encode(array('resp' => $mensaje));              
        }
        
        public function ajaxActualizarCredCliente(){
            $this->autoRender = false;            
            $posData = $this->request->data;
            $data = array();
            $data['id'] = $posData['clienteId'];
            $data['limitecredito'] = $posData['limitecredito'];                    
            
            if($this->Cliente->save($data)){
                $mensaje = "Se actualiza el Límite de Crédito del Cliente.";
            }else{
                $mensaje = "No se pudo actualizar el Límite de Crédito del Cliente. Por favor, inténtelo de nuevo.";
            }   
            echo json_encode(array('resp' => $mensaje));            
        }
        
        public function search() {
            $url = array();
            $url['action'] = 'index';

            foreach ($this->data as $kk => $vv) {
                $url[$kk] = $vv;
            }

            // redirect the user to the url
            $this->redirect($url, null, true);
        }        
}
