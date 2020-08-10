<?php
App::uses('AppController', 'Controller');
/**
 * Cotizaciones Controller
 *
 * @property Cotizacione $Cotizacione
 * @property PaginatorComponent $Paginator
 */
class CotizacionesController extends AppController {

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
		$this->Cotizacione->recursive = 0;
		$this->set('cotizaciones', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cotizacione->exists($id)) {
			throw new NotFoundException(__('Invalid cotizacione'));
		}
		$options = array('conditions' => array('Cotizacione.' . $this->Cotizacione->primaryKey => $id));
		$this->set('cotizacione', $this->Cotizacione->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Empresa');
		$this->loadModel('Usuario');
		$this->loadModel('Configuraciondato');
		
		if ($this->request->is('post')) {
			$this->Cotizacione->create();
			if ($this->Cotizacione->save($this->request->data)) {
				$this->Session->setFlash(__('The cotizacione has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cotizacione could not be saved. Please, try again.'));
			}
		}
		/*Se obtiene la informacion del vendedor*/
		$arrEmpresa = $this->Empresa->obtenerEmpresaPorId($this->Auth->user('empresa_id'));

                /*Se obtiene la informaciÃ³n del vendedor*/
                $infoVendedor = $this->Usuario->obtenerUsuarioPorId($this->Auth->user('id'));
                
                /*se obtiene la fecha de caducidad de la cotizacion*/
                $fechaActual = date('Y-m-d');
                $fechaVenceCot = $this->obtenerFechaVencimiento($fechaActual);
                
                /*Se obtiene la url de las imagenes de las empresas*/
                $strDato = "urlImgEmpresa";
                $urlImg = $this->Configuraciondato->obtenerValorDatoConfig($strDato);                  
		
		$cargueinventarios = $this->Cotizacione->Cargueinventario->find('list');
		
		$this->set(compact('usuarios', 'cargueinventarios', 'arrEmpresa', 'infoVendedor', 'urlImg', 'fechaActual', 'fechaVenceCot'));
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cotizacione->exists($id)) {
			throw new NotFoundException(__('Invalid cotizacione'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cotizacione->save($this->request->data)) {
				$this->Session->setFlash(__('The cotizacione has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cotizacione could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cotizacione.' . $this->Cotizacione->primaryKey => $id));
			$this->request->data = $this->Cotizacione->find('first', $options);
		}
		$empresas = $this->Cotizacione->Empresa->find('list');
		$usuarios = $this->Cotizacione->Usuario->find('list');
		$cargueinventarios = $this->Cotizacione->Cargueinventario->find('list');
		$this->set(compact('empresas', 'usuarios', 'cargueinventarios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cotizacione->id = $id;
		if (!$this->Cotizacione->exists()) {
			throw new NotFoundException(__('Invalid cotizacione'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cotizacione->delete()) {
			$this->Session->setFlash(__('The cotizacione has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cotizacione could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function obtenerFechaVencimiento($fechaActual){
            $nuevafecha = strtotime ( '+15 day' , strtotime ( $fechaActual) ) ;
	    $nuevaFecha = date ( 'Y-m-d' , $nuevafecha );	
	    return $nuevaFecha;
	}
	
	
/**
 * add method
 *
 * @return void
 */
	public function addProductoBarCode() {

            $this->loadModel('Cargueinventario');
            $this->loadModel('Deposito');
            
            $this->autoRender = false;
            $posData = $this->request->data;

            $usuarioId = $posData['usuarioId'];
            $fechaActual = $posData['fechaActual'];
            $fechaVencCot = $posData['fechaVencCot']; 
            $empresaId = $posData['empresaId'];            
            $descripcionProd = $posData['descProducto'];
            $nombreCliente = $posData['nombreCliente'];
            $identCliente = $posData['identCliente'];
            $FechaVencCot = $posData['FechaVencCot'];
            
            /*Se obtienen los depositos en los cuales est¨¢ el usuario*/
            $arrDepositos = $this->Deposito->obtenerDepositoUsuario($usuarioId);
            
            /*Se obtiene el id del deposito*/
            $depositosId = array();
            foreach ($arrDepositos as $dpIdx){
                $depositosId[] = $dpIdx['Deposito']['id'];
            }            
            
            //Se obtiene el producto con el codigo obtenido del lector de codigos de barras
            //que se encuentren en el stock del deposito al cual pertenece el vendedor
            $productoInfo = $this->Cargueinventario->obtenerProductosStock($depositosId, $descripcionProd);

            /*valida si se encuentra el producto descrito por el codigo de barras*/
            if(count($productoInfo) <= '0'){
                    $mensaje = "No se cuentra el producto en stock con el codigo " . $descripcionProd;
                    echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
            }else{
                /*Se obtiene el id del producto en stock*/
                $cargueinventarioId = $productoInfo['0']['Cargueinventario']['id'];

                /*se asigna la cantidad de 1 ya que es por medio del lector de codigos de barras*/
                $cantidadventa = '1';

                /*Se asigna el precio de venta sugerido al producto*/
                $precioventa = $productoInfo['0']['Cargueinventario']['precioventa'];

                /*Se valida el impuesto para el producto*/
                $valorImpuesto = $this->validarImpuestoProducto($productoInfo['0']['Cargueinventario']['producto_id'], $productoInfo['0']['Cargueinventario']['deposito_id'], $productoInfo['0']['Cargueinventario']['preciominimo']);
                
                /*se obtiene la cantidad existente en el stock*/
                $inventActual = $this->Cargueinventario->obtenerInventarioId($cargueinventarioId);
                $cantStock = $inventActual['Cargueinventario']['existenciaactual'];

                /*se valida la disponibilidad del producto*/
                if($cantStock < 0){
                    $mensaje = "No hay disponibilidad del producto en stock.";
                    echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
                }else{
                        $detalleId = $this->Cotizacione->guardarCotizacion($empresaId, $usuarioId, $cantidadventa, $precioventa, $cargueinventarioId, $valorImpuesto, $nombreCliente, $identCliente, $FechaVencCot);
                        
                        if($detalleId != '0' && $detalleId != ""){
                            echo json_encode(array('resp' => $detalleId, 'valido' => true, 'producto' => $productoInfo));
                        }else{
                            echo json_encode(array('resp' => $detalleId, 'valido' => false));
                        }
                    }                
                }                
                        
	}	
	
        public function validarImpuestoProducto($productoId, $depositoId, $precioProducto){
            $this->loadModel('CargueinventariosImpuesto');
            $impuestoProducto = $this->CargueinventariosImpuesto->obtenerImpuestosProductoId($productoId, $depositoId);
            $totalImpuestos = 0;
            for($i = 0; $i < count($impuestoProducto); $i ++){              
                $impuesto = str_replace(",", ".", $impuestoProducto[$i]['I']['valor'])/100;
                $totalImpuestos += $precioProducto * $impuesto;                
            }
            return $totalImpuestos;
        }	
        
        public function seleccionproductoventa(){
            $this->loadModel('Configuraciondato');
            $this->loadModel('CargueinventariosImpuesto');
            $this->loadModel('Cargueinventario');
            
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
        
        
	public function agregarProdCotizacion() {            		
            $this->loadModel('Cargueinventario');
            $this->autoRender = false;
            
            $posData = $this->request->data;

            $usuarioId = $posData['usuarioId'];
            $fechaActual = $posData['fechaActual'];
            $fechaVencCot = $posData['fechaVencCot']; 
            $empresaId = $posData['empresaId'];            
            $nombreCliente = $posData['nombreCliente'];
            $identCliente = $posData['identCliente'];
            $cargueInventarioId = $posData['cargueinventarioId'];
            $cantidadVenta = $posData['cantidadventa'];
            $precioVenta = $posData['precioventa']; 
            $totalVenta = $posData['totalVenta'];                    
            
            $productoInfo = $this->Cargueinventario->obtenerInventarioId($cargueInventarioId);
            
            /*Se valida el impuesto para el producto*/
            $valorImpuesto = $this->validarImpuestoProducto($productoInfo['Cargueinventario']['producto_id'], $productoInfo['Cargueinventario']['deposito_id'], $totalVenta);

            /*se obtiene la cantidad existente en el stock*/
            $inventActual = $this->Cargueinventario->obtenerInventarioId($cargueInventarioId);

            $cantStock = $inventActual['Cargueinventario']['existenciaactual'];

            /*se valida la disponibilidad del producto*/
            if($cantStock < 0){
                $mensaje = "No hay disponibilidad del producto en stock.";
                echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
            }else{            
                $detalleId = $this->Cotizacione->guardarCotizacion($empresaId, $usuarioId, $cantidadVenta, $precioVenta, $cargueInventarioId, $valorImpuesto, $nombreCliente, $identCliente, $fechaVencCot);
                
                //se obtiene el subtotal de la cotizacion realizada por un usuario
                $subTotal = $this->Cotizacione->obtenerSumaTotalProductos($usuarioId);

                //Se obtiene el total de los impuestos de la cotizacion realizada por un usuario
                $totalImp = $this->Cotizacione->obtenerSumaTotalImpuestos($usuarioId);                              

                if($detalleId != '0' && $detalleId != ""){
                    echo json_encode(array('resp' => $detalleId, 'valido' => true, 'producto' => $productoInfo, 'impuestoProd' => $valorImpuesto, 'subTotal' => $subTotal, 'totalImp' => $totalImp));
                }else{
                    echo json_encode(array('resp' => $detalleId, 'valido' => false));
                }
            }                                               
	}                         
	
}
