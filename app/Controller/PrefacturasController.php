<?php
App::uses('AppController', 'Controller');
App::uses('UsuariosController', 'Controller');

/**
 * Prefacturas Controller
 *
 * @property Prefactura $Prefactura
 * @property PaginatorComponent $Paginator
 */
class PrefacturasController extends AppController {

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
            		
            $usuarioId = $this->Auth->user('id');            
            $paginate['Prefactura.usuario_id'] = $usuarioId;
            $this->Prefactura->recursive = 0;           
            $this->set('prefacturas', $this->Paginator->paginate('Prefactura',$paginate));            
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
            		
            $this->loadModel('Tipopago');
            $this->loadModel('Notafactura');
            $this->loadModel('Usuario');
            $this->loadModel('Relacionempresa');
            
            if (!$this->Prefactura->exists($id)) {
                    throw new NotFoundException(__('La orden de compra no existe.'));
            }
            $usuarioId = $this->Auth->user('id');
            $empresaId = $this->Auth->user('empresa_id');
            $tipoPago = $this->Tipopago->find('list');            
            $options = array('conditions' => array('Prefactura.' . $this->Prefactura->primaryKey => $id));
            
            $notaFactura = $this->Notafactura->find('list');
            $vendedor = $this->Usuario->obtenerUsuarioEmpresa($empresaId);
            $relacionEmpresa = $this->Relacionempresa->obtenerListaEmpresasRelacion($empresaId);
            
            $this->set('prefactura', $this->Prefactura->find('first', $options));
            $this->set(compact('usuarioId','empresaId','tipoPago','notaFactura','vendedor','relacionEmpresa')); 
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
            		
            $this->loadModel('Prefacturasdetalle');
            $this->loadModel('Cargueinventario');
            $this->autoRender = false;
            $posData = $this->request->data;
            $usuarioId = $posData['usuarioId'];            
            $clienteId = $posData['clienteId'];
            $cargueinventarioId = $posData['cargueinventarioId'];
            $cantidadventa = $posData['cantidadventa'];
            $precioventa = $posData['precioventa'];
            
            /*Se valida si existe la prefactura*/
            $arrPrefactId = $this->Prefactura->obtenerPrefacturaId($usuarioId,$clienteId);
            if(isset($arrPrefactId['Prefactura'])){
                $prefactId = $arrPrefactId['Prefactura']['id'];
            }else{
                /*Se guarda la prefactura y se obtiene el id para almacenar el detalle*/
                $prefactId = $this->Prefactura->guardarPrefactura($usuarioId,$clienteId);                 
            }             
            
            /*se descuenta la cantidad del producto prefacturado del inventario*/
            /*se obtiene la cantidad existente en el stock*/
            $inventActual = $this->Cargueinventario->obtenerInventarioId($cargueinventarioId);
            $cantStock = $inventActual['Cargueinventario']['existenciaactual'];
            $existFinal = $cantStock - $cantidadventa;
            
            /*se actualiza la cantidad en stock tras la prefactura*/
            $this->Cargueinventario->actalizarExistenciaStock($cargueinventarioId, $existFinal);
            if($prefactId != '0'){
                $detalleId = $this->Prefacturasdetalle->guardarDetallePrefactura($cantidadventa,$precioventa,$cargueinventarioId,$prefactId);
                
                if($detalleId != '0' && $detalleId != ""){
                    echo json_encode(array('resp' => $detalleId));
                }else{
                    echo json_encode(array('resp' => $detalleId));
                }
            }
	}

        
/**
 * add method
 *
 * @return void
 */
	public function addProductoBarCode() {
            $this->loadModel('Prefacturasdetalle');
            $this->loadModel('Cargueinventario');
            $this->loadModel('Deposito');
            
            $this->autoRender = false;
            $posData = $this->request->data;

            $usuarioId = $posData['usuarioId']; 
            if(isset($posData['clienteId'])){
                $clienteId = $posData['clienteId'];
            }else{
                $clienteId = null;
            }
            
            $descripcionProd = $posData['descProducto'];
            
            /*Se obtienen los depositos en los cuales está el usuario*/
            $arrDepositos = $this->Deposito->obtenerDepositoUsuario($usuarioId);

            /*Se obtiene el id del deposito*/
            $depositosId = array();
            foreach ($arrDepositos as $dpIdx){
                $depositosId[] = $dpIdx['Deposito']['id'];
            }            
            
            //Se obtiene el producto con el codigo obtenido del lector de codigos de barras
            //que se encuentren en el stock del deposito al cual pertenece el vendedor
            $produtoInfo = $this->Cargueinventario->obtenerProductosStock($depositosId, $descripcionProd);
            
            /*valida si se encuentra el producto descrito por el codigo de barras*/
            if(count($produtoInfo) <= '0'){
                    $mensaje = "No se cuentra el producto en stock con el codigo " . $descripcionProd;
                    echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
            }else{
                /*Se obtiene el id del producto en stock*/
                $cargueinventarioId = $produtoInfo['0']['Cargueinventario']['id'];

                /*se asigna la cantidad de 1 ya que es por medio del lector de codigos de barras*/
                $cantidadventa = '1';

                /*Se asigna el precio de venta sugerido al producto*/
                $precioventa = $produtoInfo['0']['Cargueinventario']['precioventa'];

                /*Se valida si existe la prefactura*/
                $arrPrefactId = $this->Prefactura->obtenerPrefacturaId($usuarioId,$clienteId);
                if(isset($arrPrefactId['Prefactura'])){
                    $prefactId = $arrPrefactId['Prefactura']['id'];
                }else{
                    /*Se guarda la prefactura y se obtiene el id para almacenar el detalle*/
                    $prefactId = $this->Prefactura->guardarPrefactura($usuarioId,$clienteId);                 
                }             

                /*se descuenta la cantidad del producto prefacturado del inventario*/
                /*se obtiene la cantidad existente en el stock*/
                $inventActual = $this->Cargueinventario->obtenerInventarioId($cargueinventarioId);
                $cantStock = $inventActual['Cargueinventario']['existenciaactual'];
                $existFinal = $cantStock - $cantidadventa;

                /*se valida la disponibilidad del producto*/
                if($existFinal < 0){
                    $mensaje = "Por favor valide la disponibilidad del producto en stock";
                    echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
                }else{
                    /*se actualiza la cantidad en stock tras la prefactura*/
                    $this->Cargueinventario->actalizarExistenciaStock($cargueinventarioId, $existFinal);

                    if($prefactId != '0'){
                        $detalleId = $this->Prefacturasdetalle->guardarDetallePrefactura($cantidadventa,$precioventa,$cargueinventarioId,$prefactId);
                        if($detalleId != '0' && $detalleId != ""){
                            echo json_encode(array('resp' => $detalleId, 'valido' => true, 'producto' => $produtoInfo));
                        }else{
                            echo json_encode(array('resp' => $detalleId, 'valido' => false));
                        }
                    }                
                }                
            }            
	}
        

	public function addProductoClienteNuevoBarCode() {
            $this->loadModel('Prefacturasdetalle');
            $this->loadModel('Cargueinventario');
            $this->loadModel('Deposito');
            $this->loadModel('Prefactura');
            
            $this->autoRender = false;
            $posData = $this->request->data;

            $usuarioId = $posData['usuarioId']; 
            $prefacturaId = $posData['prefacturaId'];                       
            $descripcionProd = $posData['descProducto'];
            
            /*Se obtienen los depositos en los cuales está el usuario*/
            $arrDepositos = $this->Deposito->obtenerDepositoUsuario($usuarioId);

            /*Se obtiene el id del deposito*/
            $depositosId = array();
            foreach ($arrDepositos as $dpIdx){
                $depositosId[] = $dpIdx['Deposito']['id'];
            }            
            
            //Se obtiene el producto con el codigo obtenido del lector de codigos de barras
            //que se encuentren en el stock del deposito al cual pertenece el vendedor
            $produtoInfo = $this->Cargueinventario->obtenerProductosStock($depositosId, $descripcionProd);
            
            /*valida si se encuentra el producto descrito por el codigo de barras*/
            if(count($produtoInfo) <= '0'){
                    $mensaje = "No se cuentra el producto en stock con el codigo " . $descripcionProd;
                    echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
            }else{
                /*Se obtiene el id del producto en stock*/
                $cargueinventarioId = $produtoInfo['0']['Cargueinventario']['id'];

                /*se asigna la cantidad de 1 ya que es por medio del lector de codigos de barras*/
                $cantidadventa = '1';

                /*Se asigna el precio de venta sugerido al producto*/
                $precioventa = $produtoInfo['0']['Cargueinventario']['precioventa'];

                /*Se valida si existe la prefactura*/
                if($prefacturaId == "" || $prefacturaId == NULL){
                    /*Se guarda la prefactura y se obtiene el id para almacenar el detalle*/
                    $prefacturaId = $this->Prefactura->guardarPrefactura($usuarioId,$clienteId = null); 
                }             

                /*se descuenta la cantidad del producto prefacturado del inventario*/
                /*se obtiene la cantidad existente en el stock*/
                $inventActual = $this->Cargueinventario->obtenerInventarioId($cargueinventarioId);
                $cantStock = $inventActual['Cargueinventario']['existenciaactual'];
                $existFinal = $cantStock - $cantidadventa;

                /*se valida la disponibilidad del producto*/
                if($existFinal < 0){
                    $mensaje = "Por favor valide la disponibilidad del producto en stock";
                    echo json_encode(array('valido' => false, 'mensaje' => $mensaje));
                }else{
                    /*se actualiza la cantidad en stock tras la prefactura*/
                    $this->Cargueinventario->actalizarExistenciaStock($cargueinventarioId, $existFinal);

                    $detalleId = $this->Prefacturasdetalle->guardarDetallePrefactura($cantidadventa,$precioventa,$cargueinventarioId,$prefacturaId);
                    if($detalleId != '0' && $detalleId != ""){
                        echo json_encode(array('resp' => $detalleId, 'valido' => true, 'producto' => $produtoInfo, 'prefact' => $prefacturaId));
                    }else{
                        echo json_encode(array('resp' => $detalleId, 'valido' => false));
                    }
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
            /*se reagistra la actividad del uso de la aplicacion*/
            $usuariosController = new UsuariosController();
            $usuarioAct = $this->Auth->user('id');
            $usuariosController->registraractividad($usuarioAct);
            		
		if (!$this->Prefactura->exists($id)) {
			throw new NotFoundException(__('Invalid prefactura'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Prefactura->save($this->request->data)) {
				$this->Session->setFlash(__('The prefactura has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prefactura could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Prefactura.' . $this->Prefactura->primaryKey => $id));
			$this->request->data = $this->Prefactura->find('first', $options);
		}
		$usuarios = $this->Prefactura->Usuario->find('list');
		$clientes = $this->Prefactura->Cliente->find('list');
		$this->set(compact('usuarios', 'clientes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->loadModel('Prefacturasdetalle');
            $this->loadModel('Cargueinventario');
            
            /*se obtiene el detalle de la prefactura que se va eliminar*/
            $prefactDet = $this->Prefacturasdetalle->obtenerProductosPrefacturaPrefactId($id);

            /*se recorren los detalles de la factura para actualizar el stock y eliminar el registro*/
            for( $i = 0; $i < count($prefactDet); $i++){ 
                
                /*se restaura la cantidad en el inventario*/
                $cantFinal = $prefactDet[$i]['Prefacturasdetalle']['cantidad'] + $prefactDet[$i]['Cargueinventario']['existenciaactual'];
                
                /*se actualiza la cantidad en el stock*/
                if($this->Cargueinventario->actalizarExistenciaStock($prefactDet[$i]['Prefacturasdetalle']['cargueinventario_id'], $cantFinal)){
                    /*una vez actualizado el inventario, se elimina el registro del detalle de la factura*/
                    $this->Prefacturasdetalle->delete($prefactDet[$i]['Prefacturasdetalle']['id']);
                }
            }
            
            
            $this->Prefactura->id = $id;
            if (!$this->Prefactura->exists()) {
                    throw new NotFoundException(__('La Orden de Pedido no existe.'));
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->Prefactura->delete()) {
                    $this->Session->setFlash(__('La Orden de Pedido ha sido eliminada.'));
            } else {
                    $this->Session->setFlash(__('La Orden de Pedido no pudo ser eliminada. Por favor, inténtelo de nuevo.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
        
}
