<?php
App::uses('AppController', 'Controller');
App::uses('UsuariosController', 'Controller');
/**
 * Productos Controller
 *
 * @property Producto $Producto
 * @property PaginatorComponent $Paginator
 */
class ProductosController extends AppController {

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
            	
            $this->loadModel('Categoria');

            if(isset($this->passedArgs['codigo']) && $this->passedArgs['codigo'] != ""){
                $paginate['LOWER(Producto.codigo) LIKE'] = '%' . strtolower($this->passedArgs['codigo']) . '%';
            }
            
            if(isset($this->passedArgs['nombre']) && $this->passedArgs['nombre'] != ""){
                $paginate['LOWER(Producto.descripcion) LIKE'] = '%' . strtolower($this->passedArgs['nombre'] . '%');
            }

            if(isset($this->passedArgs['categorias']) && $this->passedArgs['categorias'] != ""){
                $paginate['Producto.categoria_id'] = $this->passedArgs['categorias'];
            }
            
            if(isset($this->passedArgs['marca']) && $this->passedArgs['marca'] != ""){
                $paginate['LOWER(Producto.marca) LIKE'] = '%' . strtolower($this->passedArgs['marca']) . '%';
            }
            
            $empresaId = $this->Auth->user('empresa_id');
            $paginate['Producto.empresa_id'] = $empresaId;            
            $this->Producto->recursive = 0;
            
            //Se obtiene el listado de categorias de producos de la empresa
            $categorias = $this->Categoria->obtenerCategoriasEmpresa($empresaId);
            
            $this->set('productos', $this->Paginator->paginate('Producto',$paginate));
           
            $this->set(compact('categorias'));
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
            	
            $this->loadModel('Configuraciondato');
            
            $arrEmpresa = $this->Auth->user('Empresa');
            $empresaId = $arrEmpresa['id'];  
            
            $confDato = "urlImgProducto";
            $urlImagen = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . "/";
            
            $this->Producto->recursive = 0;
            if (!$this->Producto->exists($id)) {
                    throw new NotFoundException(__('El producto no existe.'));
            }
            $options = array('conditions' => array('Producto.' . $this->Producto->primaryKey => $id));
            
            $this->set('producto', $this->Producto->find('first', $options));
            $this->set(compact('urlImagen'));
  
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
                    $posData = $this->request->data;
                    
                    /*Se obtiene el id de la empresa a la que pertenece el usuario que realiza la gestion*/
                    $arrEmpresa = $this->Auth->user('Empresa');
                    $empresaId = $arrEmpresa['id'];                     
                    
                    /*Se eliminan las comas del valor*/
                    $this->request->data['Producto']['costopromedio'] = str_replace(',', '', $this->request->data['Producto']['costopromedio']);
                                  
	            if($posData['Producto']['imagen']['name'] != ""){
	                    //Se obtiene la extension del archivo
	                    $arrExt = split("\.", $posData['Producto']['imagen']['name']);                                              
	                    
	                    $confDato = "dirImgProducto";
	                    $nombreImg = "lgPr_" . $posData['Producto']['codigo'];
	                    $this->request->data['Producto']['imagen'] = $nombreImg . "." . $arrExt['1'];                    
                    }  else {
                	unset($this->request->data['Producto']['imagen']);
                    }

                    
		    $this->Producto->create();
		    if ($this->Producto->save($this->request->data)) {
		    	if(isset($this->request->data['Producto']['imagen'])){
		                if($this->subirArchivo($posData['Producto']['imagen'], $confDato, $nombreImg, $empresaId, $this->Auth->user('id'))){
					$this->Session->setFlash(__('El producto ha sido guardado.'));
					return $this->redirect(array('action' => 'index'));                                
		                }		    	
		    	}else{
				$this->Session->setFlash(__('El producto ha sido guardado.'));
				return $this->redirect(array('action' => 'index')); 		    		
		    	}

		    }else{
			$this->Session->setFlash(__('El producto no pudo ser guardado. Por favor, inténtelo de nuevo.'));
		    }
		}
                $empresaId = $this->Auth->user('empresa_id');     
		$categorias = $this->Producto->Categoria->obtenerCategoriasEmpresa($empresaId);                               
		$this->set(compact('categorias', 'empresaId'));
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
                        
		if (!$this->Producto->exists($id)) {
			throw new NotFoundException(__('El producto no existe.'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    $posData = $this->request->data; 
                    
                    /*Se obtiene el id de la empresa a la que pertenece el usuario que realiza la gestion*/
                    $arrEmpresa = $this->Auth->user('Empresa');
                    $empresaId = $arrEmpresa['id']; 
                                        
	            if($posData['Producto']['imagen']['name']){
	                    //Se obtiene la extension del archivo
	                    $arrExt = split("\.", $posData['Producto']['imagen']['name']);                         
	                    
	                    $confDato = "dirImgProducto";
	                    $nombreImg = "lgPr_" . $posData['Producto']['codigo'];
	                    $this->request->data['Producto']['imagen'] = $nombreImg . "." . $arrExt['1'];                    
                    }else{
                    	unset($this->request->data['Producto']['imagen']);
                    }
                    
                    /*Se eliminan las comas del valor*/
                    $this->request->data['Producto']['costopromedio'] = str_replace(',', '', $this->request->data['Producto']['costopromedio']);
                    
                    if ($this->Producto->save($this->request->data)) {
                    	if(isset($this->request->data['Producto']['imagen'])){
	                        if($this->subirArchivo($posData['Producto']['imagen'], $confDato, $nombreImg, $empresaId, $this->Auth->user('id'))){
	                            $this->Session->setFlash(__('El producto ha sido guardado.'));
	                            return $this->redirect(array('action' => 'index'));                                
	                        }
                    	}else{
                            $this->Session->setFlash(__('El producto ha sido guardado.'));
                            return $this->redirect(array('action' => 'index'));                       	
                    	}

                    } else {
                            $this->Session->setFlash(__('El producto no pudo ser guardado. Por favor, inténtelo de nuevo.'));
                    }

		} else {
			$options = array('conditions' => array('Producto.' . $this->Producto->primaryKey => $id));
			$this->request->data = $this->Producto->find('first', $options);
		}
                $empresaId = $this->Auth->user('empresa_id');     
		$categorias = $this->Producto->Categoria->obtenerCategoriasEmpresa($empresaId);  				               
                $arrEmpresa = $this->Auth->user('Empresa');
                $empresaId = $arrEmpresa['id'];                
		$this->set(compact('categorias', 'empresaId'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Producto->id = $id;
		if (!$this->Producto->exists()) {
			throw new NotFoundException(__('El producto no existe.'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Producto->delete()) {
			$this->Session->setFlash(__('El producto ha sido eliminado.'));
		} else {
			$this->Session->setFlash(__('El producto no pudo ser eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $arrImagen
 * @return void
 */        
        public function subirArchivo($arrImagen, $confDato, $nombreImg, $empresaId, $usuarioId){

            $this->loadModel('Auditoria');
            $this->loadModel('Configuraciondato');
            $this->loadModel('Usuario');

            $urlImagen = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//'; 
            
            $carpeta = $urlImagen;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }            

            $file = new File($arrImagen['tmp_name']);
            $path_parts = pathinfo($arrImagen['name']);
            $ext = $path_parts['extension'];
            $filename = "{$nombreImg}.{$ext}";
            $data = $file->read();
            $file->close();
            $file = new File($urlImagen . $filename,true);
            if( $file->write($data)){
                /*Se registra en auditoria el cargue del documento*/
                    $id = '0';
                    $accion = $this->Auditoria->accionAuditoria($id);
                    $arrDescripcion['nombreImg'] = $nombreImg;  
                    $descripcion = $this->Auditoria->descripcionAuditoria($id, $arrDescripcion);
                    $this->Auditoria->logAuditoria($usuarioId, $descripcion, $accion);                
                return TRUE;                    
            }else{
                return FALSE;
            }              
        }
        
        
/**
 * productocatalogo method
 *
 * @throws NotFoundException
 * @param
 * @return void
 */         
        public function productocatalogo(){
            $categorias = $this->Producto->Categoria->find('list');
            $arrEmpresa = $this->Auth->user('Empresa');
            $empresaId = $arrEmpresa['id'];
            $this->set(compact('categorias', 'empresaId'));           
        }
        
        public function guardarproductoinventario(){
            $this->autoRender = false;
            $posData = $this->request->data;
            
            //Se obtiene la extension del archivo
            $arrExt = split("\.", $posData['Producto']['imagen']['name']);    

            /*Se obtiene el id de la empresa a la que pertenece el usuario que realiza la gestion*/
            $arrEmpresa = $this->Auth->user('Empresa');
            $empresaId = $arrEmpresa['id'];                       

            $confDato = "dirImgProducto";
            $nombreImg = "lgPr_" . $posData['Producto']['codigo'];
            $this->request->data['Producto']['imagen'] = $nombreImg . "." . $arrExt['1'];

            $this->Producto->create();
            if ($this->Producto->save($this->request->data)) {
                if($this->subirArchivo($posData['Producto']['imagen'], $confDato, $nombreImg, $empresaId, $this->Auth->user('id'))){
                    $post_id = $this->Producto->getLastInsertId();
                    echo json_encode(array('bool' => true, 'id' => $post_id));                                                   
                }
            } else {
                    echo json_encode(array('bool' => false));
            }
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