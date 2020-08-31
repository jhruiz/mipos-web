<?php
App::uses('AppController', 'Controller');
App::uses('UsuariosController', 'Controller');
App::uses ('ProductosController', 'Controller');
/**
 * Cargueinventarios Controller
 *
 * @property Cargueinventario $Cargueinventario
 * @property PaginatorComponent $Paginator
 */
class CargueinventariosController extends AppController {

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
            	
            $this->loadModel('Cuentaspendiente');
            $this->loadModel('Deposito');
            $empresaId = $this->Auth->user('empresa_id');
            $this->Cargueinventario->recursive = 0;
            
            $data = array();
            if(isset($this->passedArgs['producto']) && $this->passedArgs['producto'] != ""){
                $data['Cargueinventario.producto_id'] = $this->passedArgs['producto'];
            }
            
            if(isset($this->passedArgs['deposito']) && $this->passedArgs['deposito'] != ""){
                $data['Cargueinventario.deposito_id'] = $this->passedArgs['deposito'];
            }
            
            $data['Cargueinventario.empresa_id'] = $empresaId;
            
            /*se obtiene el stock que tiene la empresa en el inventario*/
            $cargueinventarios = $this->Cargueinventario->obtenerCargueInventario($data);            
                        
            $totalUnidades = 0;
            $valorInventario = 0;
            for ($i = 0; $i < count($cargueinventarios); $i++){
                /*se obtienen los resultados del stock*/
                $totalUnidades += $cargueinventarios[$i]['Cargueinventario']['existenciaactual'];  
                $valorInventario += ($cargueinventarios[$i]['Cargueinventario']['costoproducto']*$cargueinventarios[$i]['Cargueinventario']['existenciaactual']);
                
                /*se valida si la existencia del producto está por debajo del mínimo*/
                if($cargueinventarios[$i]['Cargueinventario']['existenciaactual'] < $cargueinventarios[$i]['Producto']['existenciaminima']){
                    $cargueinventarios[$i]['Cargueinventario']['color'] = 'danger';
                }else{
                    $cargueinventarios[$i]['Cargueinventario']['color'] = 'success';
                }
            }
            
            /*Se obtienen las cuentas pendientes que tiene la empresa*/
            $cuentasPendientes = $this->Cuentaspendiente->obtenerCuentasPendientesEmpresa($empresaId);
            
            $totalDeuda = 0;
            foreach ($cuentasPendientes as $ctasPend){
                $totalDeuda += $ctasPend['Cuentaspendiente']['totalobligacion'];
            }
            
            //Se obtienen los depositos de la empresa del usaurio que se encuentra en sesion
            $depositos = $this->Deposito->obtenerDepositoEmpresa($empresaId);
            
            $this->set(compact('cargueinventarios', 'cuentasPendientes', 'totalUnidades', 'valorInventario', 'totalDeuda', 'depositos', 'empresaId'));                        
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
            	
		if (!$this->Cargueinventario->exists($id)) {
			throw new NotFoundException(__('Invalid cargueinventario'));
		}
		$options = array('conditions' => array('Cargueinventario.' . $this->Cargueinventario->primaryKey => $id));
		$this->set('cargueinventario', $this->Cargueinventario->find('first', $options));
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
            	
            $this->loadModel('Producto');
            $this->loadModel('Configuraciondato');
            $this->loadModel('Deposito');
            $this->loadModel('Tipopago');
            $this->loadModel('Proveedore');
            $this->loadModel('Impuesto');            

            $arrEmpresa = $this->Auth->user('Empresa');
            $empresaId = $arrEmpresa['id'];

            $usuarioId = $this->Auth->user('id');

            $datConf = "urlImgProducto";
            $urlImg = $this->Configuraciondato->obtenerValorDatoConfig($datConf);                
            $productos = $this->Producto->obtenerProductosEmpresa($empresaId);
            $listDeposito = $this->Deposito->obtenerDepositoUsuario($usuarioId);
            $impuestos = $this->Impuesto->obtenerImpuestosInfo($empresaId);
            $estados = $this->Cargueinventario->Estado->find('list');		
            $tipopagos = $this->Tipopago->find('list');
            $proveedores = $this->Proveedore->obtenerProveedoresEmpresa($empresaId);
            $this->set(compact('productos', 'listDeposito', 'impuestos', 'usuarioId', 'estados', 'tipopagos', 'urlImg', 'proveedores', 'empresaId'));
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
            	
		if (!$this->Cargueinventario->exists($id)) {
			throw new NotFoundException(__('Invalid cargueinventario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cargueinventario->save($this->request->data)) {
				$this->Session->setFlash(__('The cargueinventario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cargueinventario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cargueinventario.' . $this->Cargueinventario->primaryKey => $id));
			$this->request->data = $this->Cargueinventario->find('first', $options);
		}
		$productos = $this->Cargueinventario->Producto->find('list');
		$depositos = $this->Cargueinventario->Deposito->find('list');
		$impuestos = $this->Cargueinventario->Impuesto->find('list');
		$usuarios = $this->Cargueinventario->Usuario->find('list');
		$estados = $this->Cargueinventario->Estado->find('list');
		$tipopagos = $this->Cargueinventario->Tipopago->find('list');
		$this->set(compact('productos', 'depositos', 'impuestos', 'usuarios', 'estados', 'tipopagos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cargueinventario->id = $id;
		if (!$this->Cargueinventario->exists()) {
			throw new NotFoundException(__('Invalid cargueinventario'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cargueinventario->delete()) {
			$this->Session->setFlash(__('The cargueinventario has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cargueinventario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
/**
 * cargarinventario method
 *
 * @throws NotFoundException
 * @param 
 * @return void
 */       
        public function cargarinventario(){
            if ($this->request->is('post')) {
                $this->loadModel('Deposito');
                $this->loadModel('Producto');
                $this->loadModel('Estado');
                $this->loadModel('Proveedore');
                $this->loadModel('Tipopago');
                $this->loadModel('Impuesto');
                $this->loadModel('Configuraciondato');
                $this->loadModel('Cargueinventario');
                
                $producto_id = $this->request->data("producto_id");
                $usuario_id = $this->request->data("usuario_id");
                $empresa_id = $this->request->data("empresa_id");
                
                /*Se obtienen los depositos de la empresa*/
                $depositos = $this->Deposito->obtenerListaDepositosUsuario($usuario_id);

                /*Se obtiene la información del producto*/
                $producto = $this->Producto->obtenerInfoProducto($producto_id);

                /*Se obtienen los estados activo/inactivo*/
                $estados = $this->Estado->find('list');
                
                /*Se obtienen los impuestos por empresa*/
                $impuestos = $this->Impuesto->obtenerImpuestosInfo($empresa_id);
                
                /*Se obtienen los proveedores por empresa*/
                $proveedores = $this->Proveedore->obtenerProveedoresEmpresa($empresa_id);
                
                /*Se obtienen los tipos de pago por empresa*/
                $tipopagos = $this->Tipopago->find('list');
                
                /*Se obtiene la información básica del producto en el Stock actual*/
                
                $cargueInventario = $this->Cargueinventario->obtenerProductoPorId($producto_id);
                if(count($cargueInventario) <= '0'){
                    $existenciaActual = '0';
                }else{
                    $existenciaActual = $cargueInventario['Cargueinventario']['existenciaactual'];
                }
                
                /*Se obtiene la url de las imagenes*/
                $datConf = "urlImgProducto";
                $urlImg = $this->Configuraciondato->obtenerValorDatoConfig($datConf) . '/' . $empresa_id . '/';                
                
                $this->set(compact('depositos', 'producto', 'estados', 'impuestos', 'proveedores', 'tipopagos', 'producto_id', 'usuario_id', 'empresa_id', 'urlImg', 'existenciaActual'));
            }
        }   
        
        public function ajaxProductosVenta(){
            $this->loadModel('Cargueinventario');
            $this->loadModel('Deposito');
            
            $this->autoRender = false;
            $posData = $this->request->data;
            $usuarioId = $posData['usuarioId'];
            $descProducto = $posData['descProducto'];
            
            /*Se obtienen los depositos en los cuales está el usuario*/
            $arrDepositos = $this->Deposito->obtenerDepositoUsuario($usuarioId);
                        
            /*Se obtiene el id del deposito*/
            $depositosId = array();
            foreach ($arrDepositos as $dpIdx){
                $depositosId[] = $dpIdx['Deposito']['id'];
            }

            /*Se obtienen los productos por deposito*/            
            $arrProductos = $this->Cargueinventario->obtenerProductosStock($depositosId,$descProducto);
            
            echo json_encode(array('resp' => $arrProductos));                         
        }        
        
        public function seleccionproductoventa(){
            $this->loadModel('Configuraciondato');
            $this->loadModel('CargueinventariosImpuesto');
            
            $posData = $this->request->data;
            
            $productoId = $posData['productoId'];
            
            /*Se obtiene el producto del stock*/
            $arrProducto = $this->Cargueinventario->obtenerProductoStock($productoId);

            /*Se obtiene la url para la foto del producto*/
            $strDato = "urlImgProducto";
            $urlImgProducto = $this->Configuraciondato->obtenerValorDatoConfig($strDato);
            
            /*Se obtienen los impuestos grabados al producto*/
            $arrImpuestos = $this->CargueinventariosImpuesto->obtenerImpuestosProducto($arrProducto['Cargueinventario']['id']);
            
            $this->set(compact('arrProducto','urlImgProducto','arrImpuestos'));
        }
        
        public function seleccionproductoventaclientenuevo(){
            $this->loadModel('Configuraciondato');
            $this->loadModel('CargueinventariosImpuesto');
            $this->loadModel('Cliente');
            $this->loadModel('Empresa');
            
            $posData = $this->request->data;
            
            $productoId = $posData['productoId'];                     
            
            /*Se obtiene el producto del stock*/
            $arrProducto = $this->Cargueinventario->obtenerProductoStock($productoId);

            /*Se obtiene la url para la foto del producto*/
            $strDato = "urlImgProducto";
            $urlImgProducto = $this->Configuraciondato->obtenerValorDatoConfig($strDato);
            
            /*Se obtienen los impuestos grabados al producto*/
            $arrImpuestos = $this->CargueinventariosImpuesto->obtenerImpuestosProducto($arrProducto['Cargueinventario']['id']);
            
            $this->set(compact('arrProducto','urlImgProducto','arrImpuestos'));            
        }
        
        public function seleccionproductoordencompra(){
            $this->loadModel('Configuraciondato');
            $this->loadModel('CargueinventariosImpuesto');
            $this->loadModel('Cliente');
            $this->loadModel('Empresa');
            
            $posData = $this->request->data;
            
            $productoId = $posData['productoId'];                     
            
            /*Se obtiene el producto del stock*/
            $arrProducto = $this->Cargueinventario->obtenerProductoStock($productoId);

            /*Se obtiene la url para la foto del producto*/
            $strDato = "urlImgProducto";
            $urlImgProducto = $this->Configuraciondato->obtenerValorDatoConfig($strDato);
            
            /*Se obtienen los impuestos grabados al producto*/
            $arrImpuestos = $this->CargueinventariosImpuesto->obtenerImpuestosProducto($arrProducto['Cargueinventario']['id']);
            
            $this->set(compact('arrProducto','urlImgProducto','arrImpuestos'));             
        }      
        
        
        public function descontarProductos($cantidad, $id){
            /*se obtiene la cantidad en stock del producto*/
            $arrProducto = $this->Cargueinventario->obtenerProductoPorId($id);
            
            /*se resta la cantidad */
            $cantidadFinal = $arrProducto['Cargueinventario']['existenciaactual'] - $cantidad;
            
            $data = array();
            $data['id'] = $id;
            $data['existenciaactual'] = $cantidadFinal;
            
            if($this->Cargueinventario->save($data)){
                return true;
            }else{
                return false;
            }
        }
        
        public function ajaxProductoCargueInventario(){            
            $this->loadModel('Producto');            
            $this->autoRender = false;
            $posData = $this->request->data;
            $descProducto = $posData['descProducto']; 
            $empresaId = $posData['empresaId'];
            /*Se obtienen los productos por descripcion*/            
            $arrProductos = $this->Producto->obtenerProductoCargueInventario($descProducto,$empresaId);            
            echo json_encode(array('resp' => $arrProductos));                         
        }
        
        public function ajaxProductoCargueBarcode(){  
            $this->loadModel('Producto');   
            $this->loadModel('Precargueinventario');
            $this->autoRender = false;
            $posData = $this->request->data;
            $descProducto = $posData['descProducto']; 
            $empresaId = $posData['empresaId'];
            /*Se obtiene el producto por codigo de barras*/            
            $arrProductos = $this->Producto->obtenerProductoCargueBarcode($descProducto, $empresaId);
  
            /*se valida si la consulta arroja resultado*/
            if(count($arrProductos) <= '0'){
                $mensaje = "No se encontraron productos con el código de barras " . $descProducto;
                echo json_encode(array('resp' => '1', 'mensaje' => $mensaje));
            }else{
                /*se valida si el producto ha sido pre cargado al inventario*/
                $usuarioId = $this->Auth->user('id');
                $infoPrecargue = $this->validarPrecargueInventario($usuarioId, $arrProductos['Producto']['id']);                
                if(count($infoPrecargue) <= '0'){
                    echo json_encode(array('resp' => '2', 'prod' => $arrProductos));
                }else{
                    /*se le aumenta un producto a la cantidad existente en precargue de inventario*/
                    $cantidadActual = $infoPrecargue['Precargueinventario']['cantidad'] + 1;
                    if($this->Precargueinventario->actualizarPrecargue($infoPrecargue['Precargueinventario']['id'], $cantidadActual)){
                        $mensaje = "Se agrego el producto " . $arrProductos['Producto']['descripcion'] . " correctamente al Cargue Parcial del Inventario";
                        echo json_encode(array('resp' => '3', 'mensaje' => $mensaje));
                    }else{
                        $mensaje = "No se pudo agregar el producto " . $arrProductos['Producto']['descripcion'] . ". Por favor, inténtelo nuevamente."; 
                        echo json_encode(array('resp' => '4', 'mensaje' => $mensaje));
                    }                    
                }                
            }                  
        }  
        
        public function validarPrecargueInventario($usuarioId, $productoId){
            $this->loadModel('Precargueinventario');
            $preCargueInfo = $this->Precargueinventario->obtenerPrecargueInventario($usuarioId, $productoId);
            return $preCargueInfo;
        }
        
        public function search() {
            $url = array();
            $url['action'] = 'index';
            
            foreach ($this->data as $kk => $vv) {
                if($kk != 'Cargueinventario'){
                    $url[$kk] = $vv;
                }                
            }
            // redirect the user to the url
            $this->redirect($url, null, true);
        }  
        
        public function ajaxProductoCargueIndexBarcode(){  
            $this->loadModel('Producto');   
            $this->autoRender = false;
            $posData = $this->request->data;
            $descProducto = $posData['descProducto']; 
            $empresaId = $posData['empresaId'];            
            
            /*Se obtiene el producto por codigo de barras*/            
            $arrProductos = $this->Producto->obtenerProductoCargueBarcode($descProducto, $empresaId);

            /*se valida si la consulta arroja resultado*/
            if(count($arrProductos) <= '0'){
                $mensaje = "No se encontraron productos con el código de barras " . $descProducto;
                echo json_encode(array('resp' => '1', 'mensaje' => $mensaje));
            }else{
                echo json_encode(array('resp' => '2', 'producto' =>$arrProductos));
            }                  
        }    
        
        public function cargarinvpln($mensaje = null, $errorCsv = null) {
            $this->loadModel('Configuraciondato');
            $confDato = 'planoInventario';
            $empresaId = $this->Auth->user('empresa_id');

            if ($this->request->is('post')) {
                $this->loadModel('Producto');
                $productos = new ProductosController();
                
                //se obtiene el archivo que llega por post
                $posData = $this->request->data;

                // se valida que se haya seleccionado un archivo
                if(empty($posData['Cargueplano']['cargarInventario']['name'])) {
                    $mensaje = 'Debe seleccionar un archivo CSV';
                    return $this->redirect(array('action' => 'cargarinvpln', base64_encode($mensaje), ''));
                }
                
                //se valida que el archivo sea csv
                $arrName = split('\.', $posData['Cargueplano']['cargarInventario']['name']);

                if($arrName['1'] != 'csv'){
                    $mensaje = 'Debe seleccionar un archivo con extensión CSV';
                    return $this->redirect(array('action' => 'cargarinvpln', base64_encode($mensaje), ''));
                }
                
                $nameImg = date('Ymdhis');
                
                $usuarioId = $this->Auth->user('id');

                if($productos->subirArchivo($posData['Cargueplano']['cargarInventario'], $confDato, $nameImg, $empresaId, $usuarioId)){
                    
                    //se obtiene la url del archivo 
                    $urlCsv = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//' . $nameImg . '.csv';
                    $linea = 0;
                    $archivo = fopen($urlCsv, "r");
                    
                    $arrProductos = array();
                    $arrErrores = array();
                    $errorCsv = '';
                    $mensaje = 'El cargue del inventario fue exitoso!!!';
                    //Lo recorremos
                    while (($datos = fgetcsv($archivo, ",")) == true) 
                    {
                        
                        if($linea == 0){
                            $linea++;
                            continue;
                        }
                        
                        //se obtiene un producto por referencia
                        $producto = $this->Producto->obtenerProductoPorCodigo($datos['0']);
                        
                        if(!empty($producto) && $this->validarCargue($datos)){
                            //se despeja el id de la bodega
                            $arrBodega = split('-', $datos['2']);

                            //se valida si existe impuesto y se despeja de ser asi
                            $imp = '';
                            if($datos['3'] != 'na') {
                                $arrImp = split('-', $datos['3']);
                                $imp = $arrImp['1'];
                            }
                            
                            //se despeja el id del proveedor
                            $arrProv = split('-', $datos['8']);
                            
                            $prod['producto_id'] = $producto['Producto']['id'];
                            $prod['cantidad'] = $datos['1'];
                            $prod['bodega_id'] = $arrBodega['1'];
                            $prod['impuesto_id'] = $imp;   
                            $prod['costo_producto'] = $datos['4'];
                            $prod['precio_maximo'] = $datos['5'];
                            $prod['precio_minimo'] = $datos['6'];
                            $prod['precio_venta'] = $datos['7'];
                            $prod['proveedore_id'] = $arrProv['1'];
                            $prod['tipopago'] = $datos['9'];
                            $prod['num_factura'] = $datos['10'];
                            $prod['empresa_id'] = $empresaId;
                            $prod['usuario_id'] = $usuarioId;
                            
                            $arrProductos[] = $prod;
                        }else{
                            $prodErr['producto_id'] = $datos['0'];
                            $prodErr['cantidad'] = $datos['1'];
                            $prodErr['bodega_id'] = $datos['2'];
                            $prodErr['impuesto_id'] = $datos['3'];   
                            $prodErr['costo_producto'] = $datos['4'];
                            $prodErr['precio_maximo'] = $datos['5'];
                            $prodErr['precio_minimo'] = $datos['6'];
                            $prodErr['precio_venta'] = $datos['7'];
                            $prodErr['proveedore_id'] = $datos['8'];
                            $prodErr['tipopago'] = $datos['9'];
                            $prodErr['num_factura'] = $datos['10'];
                            $arrErrores[]= $prodErr;
                        }
                    }
                    
                    //Cerramos el archivo
                    fclose($archivo);
                }else {
                    $mensaje = "No fue posible cargar el archivo plano. Por favor, inténtelo nuevamente.";
                }
                
                //se elimina el archivo de cargue de inventario
                unlink($urlCsv);
                $nameError = '';
                if(!empty($arrErrores)){
                    $nameError = date('Ymdhis');
                    $errorCsv = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//' . $nameError . '.csv';
                    $mensaje = "No fue posible realizar el cargue de todos los productos debido a inconsistencias en el archivo. ";
                    $mensaje .= "Por favor, corrija los registros e inténtelo nuevamente. Para obtener los registros con error, seleccione el siguiente botón ";
                    $this->crearPlanoErrores($errorCsv, $arrErrores);
                }  

                $this->cargarInventarioXPlano($arrProductos);
                
                return $this->redirect(array('action' => 'cargarinvpln', base64_encode($mensaje), $nameError));
                
            }
            
            if(!empty($errorCsv)){
                $errorCsv = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//' . $errorCsv . '.csv';    
            }
            
            
            $this->set(compact('mensaje', 'errorCsv', 'pst')); 
        }

        //----------------------------------Cargue inicial mediante archivo plano --------------------------//
        public function cargarinvplninicial($mensaje = null, $errorCsv = null){
            $this->loadModel('Configuraciondato');
            $confDato = 'planoInventario';
            $empresaId = $this->Auth->user('empresa_id');

            if ($this->request->is('post')) {
                $this->loadModel('Producto');
                $productos = new ProductosController();
                
                //se obtiene el archivo que llega por post
                $posData = $this->request->data;

                // se valida que se haya seleccionado un archivo
                if(empty($posData['Cargueplano']['cargarInventario']['name'])) {
                    $mensaje = 'Debe seleccionar un archivo CSV';
                    return $this->redirect(array('action' => 'cargarinvplninicial', base64_encode($mensaje), ''));
                }

                //se valida que el archivo sea csv
                $arrName = split('\.', $posData['Cargueplano']['cargarInventario']['name']);

                if($arrName['1'] != 'csv'){
                    $mensaje = 'Debe seleccionar un archivo con extensión CSV';
                    return $this->redirect(array('action' => 'cargarinvplninicial', base64_encode($mensaje), ''));
                }

                $nameImg = date('Ymdhis');
                
                $usuarioId = $this->Auth->user('id');

                if($productos->subirArchivo($posData['Cargueplano']['cargarInventario'], $confDato, $nameImg, $empresaId, $usuarioId)){
                    //se obtiene la url del archivo 
                    $urlCsv = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//' . $nameImg . '.csv';
                    $linea = 0;
                    $archivo = fopen($urlCsv, "r");

                    $arrProductos = array();
                    $arrErrores = array();
                    $errorCsv = '';
                    $mensaje = 'El cargue del inventario fue exitoso!!!';
                    /*
                    * $pesoFlag = true-> hay información en esa celda del array $datos[]
                    * $pesoFlag = false-> empty
                    */ 
                    $pesoFlag = true; //inicializa en true
                    //Lo recorremos
                    while (($datos = fgetcsv($archivo, ",")) == true)
                    {
                        $pesoFlag = true;

                        if($linea == 0){
                            $linea++;
                            continue;
                        }
                        
                        /*
                        * si datos[n] != empty ---> guardar en array arrProductos[]
                        * si datos[n] == empty ---> pesoFlag:false, guardar en array arrErrores[]
                        */ 
                        if(!empty($datos['0'])){
                            // codigo producto
                            $prod['cod_producto'] = $datos['0'];
                            $prodErr['cod_producto'] = $datos['0'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['cod_producto'] = '""';
                        }

                        if(!empty($datos['1'])){
                            // cantidad producto
                            $prod['cantidad'] = $datos['1'];
                            $prodErr['cantidad'] = $datos['1'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['cantidad'] = '""';
                        }

                        if(!empty($datos['2'])){
                            //se despeja el id de la bodega
                            $arrBodega = split('-', $datos['2']);
                            //bodega producto
                            $prod['bodega_id'] = $arrBodega['1'];
                            $prodErr['bodega_id'] = $datos['2'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['bodega_id'] = '""';
                        }
                        
                        if(!empty($datos['3'])){
                            //se valida si existe impuesto y se despeja de ser asi
                            $imp = '';
                            if($datos['3'] != 'na') {
                                $arrImp = split('-', $datos['3']);
                                $imp = $arrImp['1'];
                                //impuesto producto
                                $prod['impuesto_id'] = $imp;
                                $prodErr['impuesto_id'] = $datos['3'];
                            }
                        }else{
                            $pesoFlag= false;
                            $prodErr['impuesto_id'] = '""';
                        }

                        if(!empty($datos['4'])){
                            // costo producto
                            $prod['costo_producto'] = $datos['4'];
                            $prodErr['costo_producto'] = $datos['4'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['costo_producto'] = '';
                        }

                        if(!empty($datos['5'])){ //$dato['5] -> precio_venta = precio_maximo
                            // precio maximo
                            $prod['precio_maximo'] = $datos['5'];
                            $prodErr['precio_venta'] = $datos['5'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['precio_venta'] = '""';
                        }

                        if(!empty($datos['4'])){ //$dato['4'] -> costo producto = precio minimo
                            // precio minimo
                            $prod['precio_minimo'] = $datos['4'];
                            $prodErr['costo_producto'] = $datos['4'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['precio_producto'] = '""';
                        }

                        if(!empty($datos['5'])){
                            // precio venta
                            $prod['precio_venta'] = $datos['5'];
                            $prodErr['precio_venta'] = $datos['5'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['precio_venta'] = '""';
                        }

                        if(!empty($datos['6'])){
                            //se despeja el id del proveedor
                            $arrProv = split('-', $datos['6']);
                            //proveedor id
                            $prod['proveedores_id'] = $arrProv['1'];
                            $prodErr['proveedores_id'] = $datos['6'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['proveedores_id'] = '""';
                        }

                        if(!empty($datos['7'])){
                            // num factura
                            $prod['num_factura'] = $datos['7'];
                            $prodErr['num_factura'] = $datos['7'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['num_factura'] = '""';
                        }

                        if(!empty($datos['8'])){
                            // num factura
                            $prod['descripcion_producto'] = $datos['8'];
                            $prodErr['descripcion_producto'] = $datos['8'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['descripcion_producto'] = '""';
                        }
                        
                        if(!empty($datos['9'])){
                            //se despeja el id del categoria
                            $arrCategoria = split('-', $datos['9']);
                            //categoria id
                            $prod['categoria_id'] = $arrCategoria['1'];
                            $prodErr['categoria_id'] = $datos['9'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['categoria_id'] = '""';
                        }
                        
                        if(!empty($datos['10'])){
                            //se despeja el id de marca
                            $arrMarca = split('-', $datos['10']);
                            //marca id
                            $prod['marca_id'] = $arrMarca['1'];
                            $prodErr['marca_id'] = $datos['10'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['marca_id'] = '""';
                        }
                        
                        if(!empty($datos['11'])){
                            // existencia minima
                            $prod['existencia_min'] = $datos['11'];
                            $prodErr['existencia_min'] = $datos['11'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['existencia_min'] = '""';
                        }

                        if(!empty($datos['12'])){
                            // existencia maxima
                            $prod['existencia_max'] = $datos['12'];
                            $prodErr['existencia_max'] = $datos['12'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['existencia_max'] = '""';
                        }

                        if(!empty($datos['13'])){
                            // costo promedio
                            $prod['costo_prom'] = $datos['13'];
                            $prodErr['costo_prom'] = $datos['13'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['costo_prom'] = '""';
                        }

                        if(!empty($datos['14'])){
                            // serie producto
                            $prod['serie_producto'] = $datos['14'];
                            $prodErr['serie_producto'] = $datos['14'];
                        }else{
                            $pesoFlag= false;
                            $prodErr['serie_producto'] = '""';
                        }

                        /**
                         *  $pesoFlag : 
                         *   true -> crea el producto
                         *  false -> crear el array de errores
                         */
                        if($pesoFlag){
                            $prod['tipopago'] = 1;
                            $prod['mostrar_catalogo'] = '1';
                            $prod['empresa_id'] = $empresaId;
                            $prod['usuario_id'] = $usuarioId;
                            
                            $arrProductos[] = $prod;
                            //array_push ($arrProductos , $prod );
                            // echo '<pre>';
                            // print_r($arrProductos);
                            // echo '</pre>';
                            // die();   
                        }else{
                            $arrErrores[] = $prodErr;
                            // echo '<pre>';
                            // print_r($arrErrores);
                            // echo '</pre>';
                            // die(); 
                        }          
                    }
                    //Cerramos el archivo
                    fclose($archivo);

                } else {
                    $mensaje = "No fue posible cargar el archivo plano. Por favor, inténtelo nuevamente.";
                }
                //se elimina el archivo de cargue de inventario
                unlink($urlCsv);
                $nameError = '';

                // verifica si el arreglo esta vacio
                if(empty($arrProductos) && empty($arrErrores) ){
                    $mensaje = "El archivo CSV se encuentra vacio, por favor verifique el contenido!!!";
                    return $this->redirect(array('action' => 'cargarinvplninicial', base64_encode($mensaje), $nameError));
                }

                if(!empty($arrErrores)){
                    $nameError = date('Ymdhis');
                    $errorCsv = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//' . $nameError . '.csv';
                    $mensaje = "No fue posible realizar el cargue de todos los productos debido a inconsistencias en el archivo. ";
                    $mensaje .= "Por favor, corrija los registros e inténtelo nuevamente. Para obtener los registros con error, seleccione el siguiente botón ";
                    $this->crearPlanoErroresCargueInicial($errorCsv, $arrErrores);
                } 
                $this->cargarInventarioXPlanoInicial($arrProductos); 

                return $this->redirect(array('action' => 'cargarinvplninicial', base64_encode($mensaje), $nameError));
                
            }

            if(!empty($errorCsv)){
                $errorCsv = $this->Configuraciondato->obtenerValorDatoConfig($confDato) . $empresaId . '//' . $errorCsv . '.csv';    
            }

            $this->set(compact('mensaje', 'errorCsv', 'pst'));
        }
        //----------------------------------Finaliza aqui --------------------------//

        // valida que se hayan ingresado todos los datos del cargue de inventario
        public function validarCargue($datos){

            $resp = true;
            
            foreach($datos as $dat){
                
                if(empty($dat)) {
                    $resp = false;
                    break;
                }
            }
            
            return $resp;
        }
        
        //se crea el plano indicando los productos que no fue posible cargar
        public function crearPlanoErrores($urlCsv, $arrErrores) {

            $file_handle = fopen($urlCsv, 'w');
            $delimitador = ',';
            $encapsulador = '"';
            
            $arrCabecera[] = array( 'cod_producto', 'cantidad', 'cod_bodega', 
                                    'cod_impuesto', 'costo_producto', 'precio_maximo',
                                    'precio_minimo', 'precio_venta', 'cod_proveedor', 
                                    'cod_tipo_pago', 'num_fatura');
                                    
            foreach($arrCabecera as $cab) {
                fputcsv($file_handle, $cab, $delimitador, $encapsulador);
            }
            
            foreach ($arrErrores as $linea) {
                fputcsv($file_handle, $linea, $delimitador, $encapsulador);
            }
            
            rewind($file_handle);
            fclose($file_handle);  

        }

        //se crea el plano indicando los productos que no fue posible cargar
        public function crearPlanoErroresCargueInicial($urlCsv, $arrErrores) {

            $file_handle = fopen($urlCsv, 'w');
            $delimitador = ',';
            $encapsulador = '"';
            
            $arrCabecera[] = array( 'cod_producto', 'cantidad', 'cod_bodega', 
                                    'cod_impuesto', 'costo_producto', 'precio_venta', 
                                    'cod_proveedor', 'num_factura', 'descripcion_producto',
                                    'cod_categoria_producto', 'cod_marca_producto', 'existencia_minima', 
                                    'existencia_maxima', 'costo_promedio', 'serie_producto');
                                    
            foreach($arrCabecera as $cab) {
                fputcsv($file_handle, $cab, $delimitador, $encapsulador);
            }

            // echo('<pre>');
            // print_r($arrErrores);
            // echo('</pre>');
            // die();

            foreach ($arrErrores as $linea) {
                fputcsv($file_handle, $linea, $delimitador, $encapsulador);
                //fputcsv($file_handle, array($linea), $delimitador, $encapsulador);
            }
            
            rewind($file_handle);
            fclose($file_handle);  

        }
        
        //se carga al inventario los productos relacionados en el documento 
        public function cargarInventarioXPlano($arrProductos){
            $this->loadModel('Documento');
            $this->loadModel('Detalledocumento');
            $this->loadModel('Proveedore');
            $this->loadModel('Cuentaspendiente');
            $this->loadModel('Cargueinventario');
            $this->loadModel('Anotacione');
            $this->loadModel('Auditoria');
            
            try {
                /*se crea el documento*/
                $tipoDocumentoId = '1';
               
                /*se guarda el documento y se obtiene el id del mismo*/
                $documentoId = $this->Documento->guardarDocumento($tipoDocumentoId,$arrProductos['0']['empresa_id'],$arrProductos['0']['usuario_id']);  
                
                /*se actualiza el codigo del documento ya que en mysql no se admite mas de un autoincrement*/
                $this->Documento->actualizarCodigoDocumento($documentoId); 
                
                
                /*se guarda la informacion del detalle del documento y del inventario*/
                foreach ($arrProductos as $infP){

                    if(!$this->Detalledocumento->guardarDetalleDocumento(   $infP['producto_id'], $depOrg=null, $infP['bodega_id'],
                                                                            $infP['costo_producto'], $infP['cantidad'], $infP['precio_maximo'],
                                                                            $infP['precio_minimo'],$infP['precio_venta'],$infP['proveedore_id'],
                                                                            $infP['tipopago'], $infP['num_factura'], $documentoId)){  
                    }
                    
                    /*Se valida si el producto que se va cargar ya existe en el inventario*/
                    $infoProducto = $this->Cargueinventario->obtenerProductoPorIdDeposito($infP['producto_id'],$infP['bodega_id']);
                    if(count($infoProducto)>'0'){
                        /*Si existe se debe actualizar la información del inventario*/
                        $cantidadActual = $infoProducto['Cargueinventario']['existenciaactual'];
                        $costoActual = $infoProducto['Cargueinventario']['costoproducto'];
                        $cantidadACargar = $infP['cantidad'];
                        $costoACargar = $infP['costo_producto'];
    
                        $promedioPonderado = floor(($cantidadActual*$costoActual)+($cantidadACargar*$costoACargar))/($cantidadActual+$cantidadACargar);
                        $cantidadFinal = $cantidadActual+$cantidadACargar;
                        
                        $data = array();
                        $data['id'] = $infoProducto['Cargueinventario']['id'];
                        $data['deposito_id'] = $infP['bodega_id'];
                        $data['costoproducto'] = $promedioPonderado;
                        $data['existenciaactual'] = $cantidadFinal;
                        $data['preciomaximo'] = $infP['precio_maximo'];
                        $data['preciominimo'] = $infP['precio_minimo'];
                        $data['precioventa'] = $infP['precio_venta'];
                        $data['usuario_id'] = $infP['usuario_id'];
                        $data['estado_id'] = '1';
                        $data['proveedore_id'] = $infP['proveedore_id'];
                        $data['tipopago_id'] = null;
                        $data['numerofactura'] = $infP['num_factura'];
                        
                        /*Se actualiza el registro del producto en el inventario*/
                        $this->Cargueinventario->save($data);
                        
                    }else{
                        /*Si el producto no existe en el deposito, se crea*/
                        if(!$this->Cargueinventario->guardarCargueInventario(   $infP['producto_id'], $infP['bodega_id'], $infP['costo_producto'],
                                                                                $infP['cantidad'], $infP['precio_maximo'], $infP['precio_minimo'],
                                                                                $infP['precio_venta'], $infP['usuario_id'], '1',
                                                                                $infP['proveedore_id'], null, $infP['num_factura'], 
                                                                                $infP['empresa_id'])){
                           } 
                    }
                    
                    /*se actualizan los datos de los impuestos para el producto*/
                    $this->actualizarInfoImpuestos($infP['producto_id'], $infP['bodega_id'], $infP['impuesto_id']);
                    
                    /*Si el tipo de pago es crédito, se guarda en cuentas por pagar*/
                    if($infP['tipopago'] == '2'){
                        //se obtiene la información del proveedor
                        $infoProv = $this->Proveedore->obtenerProveedorPorId($infP['proveedore_id']);
                        $fechaPago = $this->sumarDiasFecha(date('Y-m-d'),$infoProv['Proveedore']['diascredito']);
    
                        $totalObligacion = ($infP['costo_producto'] * $infP['cantidad']);
                        $this->Cuentaspendiente->guardarCuentasPendientes(  $documentoId, $infP['producto_id'], $infP['bodega_id'],
                                                                            $infP['costo_producto'], $infP['cantidad'], $infP['proveedore_id'],
                                                                            $infP['num_factura'], $infP['usuario_id'], $arrProductos['empresa_id'], 
                                                                            $totalObligacion, $fechaPago);
                    }
                }
                
                /*Se guarda la nota hecha sobre el documento*/
                $this->Anotacione->guardarNota('Cargue inventario por archivo plano', $infP['usuario_id'], $documentoId);
                
                /*Se obtiene la info del documento cargado para el registro en auditoria*/
                $infoDoc = $this->Documento->obtenerInfoDocumentoId($documentoId);
                
                /*Se obtiene la acción de la auditoria*/
                $idAud = '1';
                $accion = $this->Auditoria->accionAuditoria($idAud);
                
                /*Se obtiene la descripcion de la auditoria*/
                $arrDescripcionAud['codigoDoc'] = $infoDoc['Documento']['codigo'];
                $descripcion = $this->Auditoria->descripcionAuditoria($idAud, $arrDescripcionAud);
                
                /*Se guarda la la auditoria*/
                $this->Auditoria->logAuditoria($infP['usuario_id'], $descripcion, $accion);
                
                return true;
                
            } catch (Exception $e) {
                return false;
            }
            
        }

        //------------------------se carga al inventario los productos NUEVOS relacionados en el documento  --------------------------//
        public function cargarInventarioXPlanoInicial($arrProductos){

            $this->loadModel('Documento');
            $this->loadModel('Detalledocumento');
            $this->loadModel('Proveedore');
            $this->loadModel('Cuentaspendiente');
            $this->loadModel('Cargueinventario');
            $this->loadModel('Anotacione');
            $this->loadModel('Auditoria');
            $this->loadModel('Producto');

            // echo '<pre>';
            // print_r($arrProductos);
            // echo '</pre>';
            // die();

            try{
                //se crea el documento
                $tipoDocumentoId = '1';

                if(isset($arrProductos[0])){
                    //se guarda el documento y se obtiene el id del mismo
                    $documentoId = $this->Documento->guardarDocumento($tipoDocumentoId,$arrProductos['0']['empresa_id'],$arrProductos['0']['usuario_id']);  

                    //se actualiza el codigo del documento ya que en mysql no se admite mas de un autoincrement//
                    $this->Documento->actualizarCodigoDocumento($documentoId); 
                }
                //se guarda la informacion del detalle del documento y del inventario
                foreach ($arrProductos as $infP){
                    
                    //obtiene los datos necesarios para crear el producto
                    $prodCod = ($infP['cod_producto']);
                    $proDesc = ($infP['descripcion_producto']);
                    $prodCate = ($infP['categoria_id']);
                    $prodMarca = ($infP['marca_id']);
                    $prodExistMin = ($infP['existencia_min']);
                    $prodExistMax = ($infP['existencia_max']);
                    $prodCostoProm = ($infP['costo_prom']);
                    $prodMostraCatalogo = ($infP['mostrar_catalogo']);
                    $empresa_id = ($infP['empresa_id']);
                    $prodSerie = ($infP['serie_producto']);
 
                    $ProductoId = null; //se inicializa vacio
                    
                    //verifica si el producto existe, salida->true/false
                    $existenciaProducto = $this->Producto->verificarExistenciaProducto($prodCod, $prodSerie);

                    if(isset($existenciaProducto['Producto'])){
                        //si existe el producto, obtiene el id
                        $ProductoId = $existenciaProducto['Producto']['id'];

                        //Si existe se debe actualizar la información del inventario (cargue inventario)
                        $infoProducto = $this->Cargueinventario->obtenerProductoPorIdDeposito($ProductoId,$infP['bodega_id']);
                        
                        $cantidadActual = $infoProducto['Cargueinventario']['existenciaactual'];
                        $costoActual = $infoProducto['Cargueinventario']['costoproducto'];

                        $cantidadACargar = ($infP['cantidad']);
                        $costoACargar = ($infP['costo_producto']);

                        $promedioPonderado = floor(($cantidadActual*$costoActual)+($cantidadACargar*$costoACargar))/($cantidadActual+$cantidadACargar);
                        $cantidadFinal = $cantidadActual+$cantidadACargar;
                        
                        $data = array();
                        $data['id'] = $infoProducto['Cargueinventario']['id'];
                        $data['deposito_id'] = $infP['bodega_id'];
                        $data['costoproducto'] = $promedioPonderado;
                        $data['existenciaactual'] = $cantidadFinal;
                        $data['preciomaximo'] = $infP['precio_maximo'];
                        $data['preciominimo'] = $infP['precio_minimo'];
                        $data['precioventa'] = $infP['precio_venta'];
                        $data['usuario_id'] = $infP['usuario_id'];
                        $data['estado_id'] = '1';
                        $data['proveedore_id'] = $infP['proveedores_id'];
                        $data['tipopago_id'] = '1';
                        $data['numerofactura'] = $infP['num_factura'];
                        $data['empresa_id'] = $infP['empresa_id'];
                        
                        /*Se actualiza el registro del producto en el inventario*/
                        $this->Cargueinventario->save($data);
                        // Actualiza el valor del producto en la base de datos
                        $this->Producto->actualizarCostoProducto($ProductoId, $infP['costo_prom']);
                    }else{
                        //Si no existe el producto, Se crea (sin imagen) y se obtiene el id
                        $ProductoId = $this->Producto->guardarProducto( 
                            $prodCod, $proDesc, $prodCate, 
                            $prodMarca, $prodExistMin, $prodExistMax, 
                            $prodCostoProm, $prodMostraCatalogo, $empresa_id, 
                            $prodSerie
                        );

                        
                    $detDocBodegaId = ($infP['bodega_id']);
                    $detDocCostoProducto = ($infP['costo_producto']);
                    $detDocCantidad = ($infP['cantidad']);
                    $detDocPrecioMax = ($infP['precio_maximo']);
                    $detDocPrecioMin = ($infP['precio_minimo']);
                    $detDocPrecioVenta = ($infP['precio_venta']);
                    $detDocProveedores = ($infP['proveedores_id']);
                    $detDocTipoPago = ($infP['tipopago']); 
                    $detDocNumFact = ($infP['num_factura']);

                    
                    if(!$this->Detalledocumento->guardarDetalleDocumento(    
                        $ProductoId,
                        $depOrg=null, 
                        $detDocBodegaId,                                                    
                        $detDocCostoProducto, 
                        $detDocCantidad, 
                        $detDocPrecioMax,                                                    
                        $detDocPrecioMin,
                        $detDocPrecioVenta,
                        $detDocProveedores,
                        $detDocTipoPago, 
                        $detDocNumFact, 
                        $documentoId)){  
                    }

                    $cargueInvBodegaId = ($infP['bodega_id']);
                    $cargueInvCostoProducto = ($infP['costo_producto']);
                    $cargueInvCantidad = ($infP['cantidad']);
                    $cargueInvPrecioMax = ($infP['precio_maximo']);
                    $cargueInvPrecioMin = ($infP['precio_minimo']);
                    $cargueInvPrecioVenta = ($infP['precio_venta']);
                    $cargueInvUsuarioId = ($infP['usuario_id']);
                    $cargueInvProveedorId = ($infP['proveedores_id']);
                    $cargueInvNumFactura = ($infP['num_factura']);
                    $cargueInvEmpresaId = ($infP['empresa_id']);
                    
                    //se carga en el inventario el producto
                    if(!$this->Cargueinventario->guardarCargueInventario(   
                        //$infP['producto_id'],
                        $ProductoId, 
                        $cargueInvBodegaId, 
                        $cargueInvCostoProducto,
                        $cargueInvCantidad, 
                        $cargueInvPrecioMax, 
                        $cargueInvPrecioMin,
                        $cargueInvPrecioVenta, 
                        $cargueInvUsuarioId, 
                        '1',
                        $cargueInvProveedorId, 
                        null, 
                        $cargueInvNumFactura, 
                        $cargueInvEmpresaId)){
                    }         
                }
                    }


                if(isset($arrProductos[0])){
                    //Se guarda la nota hecha sobre el documento
                    $this->Anotacione->guardarNota('Cargue inventario por archivo plano', $infP['usuario_id'], $documentoId);

                    //Se obtiene la info del documento cargado para el registro en auditoria
                    $infoDoc = $this->Documento->obtenerInfoDocumentoId($documentoId);

                    //Se obtiene la acción de la auditoria
                    $idAud = '1';
                    $accion = $this->Auditoria->accionAuditoria($idAud);

                    //Se obtiene la descripcion de la auditoria
                    $arrDescripcionAud['codigoDoc'] = $infoDoc['Documento']['codigo'];
                    $descripcion = $this->Auditoria->descripcionAuditoria($idAud, $arrDescripcionAud);

                    //Se guarda la la auditoria
                    $this->Auditoria->logAuditoria($infP['usuario_id'], $descripcion, $accion);            
                }

                return true;
                
            } catch (Exception $e) {
                return false;
            }
            
        }
        //----------------------------------Finaliza aqui --------------------------//

        public function actualizarInfoImpuestos($productoId,$depositoId,$impuestoId){
            
            $this->loadModel('CargueinventariosImpuesto');
            
            //Se obtiene el id del cargue del inventario
            $infoCargueInv = $this->Cargueinventario->obtenerProductoPorIdDeposito($productoId, $depositoId);
            
            //Se elimina el regisro de impuestos que tenga asignado el cargue
            $this->CargueinventariosImpuesto->deleteAll(array('CargueinventariosImpuesto.cargueinventario_id' => $infoCargueInv['Cargueinventario']['id']), false);
            
            if(!empty($impuestoId)){
                $this->CargueinventariosImpuesto->guardarImpuestosCargueInv($infoCargueInv['Cargueinventario']['id'], $impuestoId);                
            }


        }         
        
        public function sumarDiasFecha($fecha,$dias){
            if(empty($dias)){
                $dias = 30;
            }
            $fechaNew = new DateTime($fecha);
            $fechaNew->add(new DateInterval('P' . $dias . 'D'));
            $fechaFin = $fechaNew->format('Y-m-d');
            return $fechaFin;          
        }        
}
