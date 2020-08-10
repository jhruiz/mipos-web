<?php
App::uses('AppController', 'Controller');
App::uses('UsuariosController', 'Controller');
/**
 * Facturas Controller
 *
 * @property Factura $Factura
 * @property PaginatorComponent $Paginator
 */
class FacturasController extends AppController {

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
            		
            $this->loadModel('Tipopago');
            $this->loadModel('Usuario');
            if(isset($this->passedArgs['codigo']) && $this->passedArgs['codigo'] != ""){
                $paginate['Factura.codigo LIKE'] = '%' . $this->passedArgs['codigo'] . '%';
            } 
            
            if(isset($this->passedArgs['consecutivo']) && $this->passedArgs['consecutivo'] != ""){
                $paginate['Factura.consecutivodian LIKE'] = '%' . $this->passedArgs['consecutivo'] . '%';
            }             
            
            if(isset($this->passedArgs['vendedor']) && $this->passedArgs['vendedor'] != ""){
                $paginate['Factura.usuario_id'] = $this->passedArgs['vendedor'];
            }            

            if(isset($this->passedArgs['fechafactura']) && $this->passedArgs['fechafactura'] != ""){
                $paginate['Factura.created BETWEEN ? AND ?'] = array($this->passedArgs['fechafactura'] . ' 00:00:00', $this->passedArgs['fechafactura'] . ' 23:59:59');
            }            

            if(isset($this->passedArgs['fechavence']) && $this->passedArgs['fechavence'] != ""){
                $paginate['Factura.fechavence BETWEEN ? AND ?'] = array($this->passedArgs['fechavence'] . ' 00:00:00', $this->passedArgs['fechavence'] . ' 23:59:59');
            }            

            if(isset($this->passedArgs['tipopago']) && $this->passedArgs['tipopago'] != ""){
                $paginate['Factura.tipopago_id'] = $this->passedArgs['tipopago'];
            }            
            
            //Se obtiene el listado de tipos de pago para el filtro
            $tipoPago = $this->Tipopago->obtenerListaTiposPagosAll();
            $empresaId = $this->Auth->user('empresa_id');
            
            //se obtienen los usuarios de la empresa para el filtro
            $usuario = $this->Usuario->obtenerUsuarioEmpresa($empresaId);
            $paginate['Factura.empresa_id'] = $empresaId;
            $this->Factura->recursive = 0;
            $this->set('facturas', $this->Paginator->paginate('Factura',$paginate));
            $this->set(compact('tipoPago', 'usuario'));
                        
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
            		
            $this->loadModel('Empresa');
            $this->loadModel('Ventarapida');
            $this->loadModel('Usuario');
            $this->loadModel('Facturasdetalle');
            $this->loadModel('Configuraciondato');
            $this->loadModel('Tipopago');
            $this->loadModel('Regimene');
            $this->loadModel('Relacionempresa');
            $this->loadModel('FacturasNotafactura');
            $this->loadModel('Cuentascliente');
            
            /*se obtiene la información de la factura por el id*/
            $infoFact = $this->Factura->obtenerInfoFacturaPorId($id);
            
            if($infoFact['Factura']['relacionempresa'] == ""){
                /*se obtiene la información de la empresa*/
                $infoEmpresa = $this->Empresa->obtenerEmpresaPorId($infoFact['Factura']['empresa_id']);                            
            }else{
                $infoEmpresaRel = $this->Relacionempresa->obtenerEmpresaRelacionadaPorId($infoFact['Factura']['relacionempresa']);
            }
            
            /*Se obtiene la información del vendedor*/
            $infoVendedor = $this->Usuario->obtenerUsuarioPorId($infoFact['Factura']['usuario_id']);
            
            /*Se obtiene el detalle de la factura*/
            $infoDetFact = $this->Facturasdetalle->obtenerFacturaDetalleFactId($id);
            
            /*Se recorre el detalle para obtener el total de la venta y el total de productos*/
            $ttalUnid = '0';
            $subTtalVent = '0';
	    $adicionImpuestos = array();
            for($i= 0; $i < count($infoDetFact); $i++){  
                //Se valida si el producto tiene impuestos
                $adicionImpuestos[$i] = $this->validarImpuestoProducto($infoDetFact[$i]);                     
                $ttalUnid += $infoDetFact[$i]['Facturasdetalle']['cantidad'];
                $subTtalVent += $infoDetFact[$i]['Facturasdetalle']['costoventa'] * $infoDetFact[$i]['Facturasdetalle']['cantidad'];
                        
                if(isset($adicionImpuestos[$i]['decripcion'])){
	                $infoDetFact[$i]['Facturasdetalle']['baseiva'] = $adicionImpuestos[$i]['decripcion'];
	                $infoDetFact[$i]['Facturasdetalle']['valorconiva'] = $adicionImpuestos[$i]['valorProd'];
	                $infoDetFact[$i]['Facturasdetalle']['valoriva'] = $adicionImpuestos[$i]['valorImpuesto'];    
	                $infoDetFact[$i]['Facturasdetalle']['iva'] = $adicionImpuestos[$i]['baseIva'];    	                                 	                
                }else{
	                $infoDetFact[$i]['Facturasdetalle']['baseiva'] = 'N/A';
	                $infoDetFact[$i]['Facturasdetalle']['valorconiva'] = $infoDetFact[$i]['Facturasdetalle']['costototal'];
	                $infoDetFact[$i]['Facturasdetalle']['valoriva'] = 'N/A';    
	                $infoDetFact[$i]['Facturasdetalle']['iva'] = 'N/A';                              
                }          
                                                
            }            

            $tatalVentaIva = $subTtalVent;
            $impuestos = '0';
            //Se obtiene el valor de la venta mas iva
            foreach ($adicionImpuestos as $adImp){            
                foreach ($adImp as $imp){
                    if(isset($imp['valorImpuesto'])){
                        $impuestos += $imp['valorImpuesto'];
                    }                    
                }
            }
            
            $tatalVentaIva += $impuestos;
            $iva = $impuestos;
            
            /*se obtiene el consecutivo de la factura*/
            if($infoFact['Factura']['consecutivodian'] != ""){
                $consecutivoFact = $infoFact['Factura']['consecutivodian'];                
            }else{
                $consecutivoFact = $infoFact['Factura']['codigo'];                
            } 
            
            /*se valida si fue una venta rapida*/
            $infoVentaRapida = $this->Ventarapida->obtenerInfoVentaFactId($id);
            
            /*Se obtiene la url de las imagenes de las empresas*/
            $strDato = "urlImgEmpresa";
            $urlImg = $this->Configuraciondato->obtenerValorDatoConfig($strDato);   
            
            /*se obtiene el tipo de pago de la transacción*/
            $infoTipoPago = $this->Tipopago->obtenerTipoPagoPorId($infoFact['Factura']['tipopago_id']);
            
            /*se obtiene el regimen del deposito*/
            if(count($infoDetFact) > 0){
                $regimen = $this->Regimene->obtenerRegimenPorId($infoDetFact['0']['Deposito']['regimene_id']);
            }            
            
            /*se obtiene la cartera del cliente*/
            $totalCartera = '0';
            if(isset($infoFact['Cliente']['id']) && $infoFact['Cliente']['id'] != ""){
            	$arrCartera = $this->Cuentascliente->obtenerCarteraCliente($infoFact['Cliente']['id']);
            	if(count($arrCartera) > '0'){
            	    for($j = 0; $j < count($arrCartera); $j++){
            	        $totalCartera += $arrCartera[$j]['Cuentascliente']['totalobligacion'];
            	    }            	    
            	}
            }
            
            /*Se obtiene la nota de la factura*/
            $notaFactura = $this->FacturasNotafactura->obtenerNotaFactura($id);

            $this->set(compact('infoFact','infoEmpresa','infoVendedor','infoVentaRapida','infoDetFact','consecutivoFact','urlImg','infoTipoPago'));
            $this->set(compact('ttalUnid','subTtalVent','tatalVentaIva','regimen','iva','infoEmpresaRel','notaFactura','totalCartera'));
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
            		
            $this->loadModel('Tipopago');
            $this->loadModel('Notafactura');
            $this->loadModel('Usuario');
            $this->loadModel('Relacionempresa');
            if ($this->request->is('post')) {
                    $this->Factura->create();
                    if ($this->Factura->save($this->request->data)) {
                            $this->Session->setFlash(__('The factura has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The factura could not be saved. Please, try again.'));
                    }
            }
            $empresaId = $this->Auth->user('empresa_id');
            $usuarioId = $this->Auth->user('id');
            $tipoPago = $this->Tipopago->find('list');
            $notaFactura = $this->Notafactura->obtenerNotasFacturasEmpresa($empresaId);
            $vendedor = $this->Usuario->obtenerUsuarioEmpresa($empresaId);
            $relacionEmpresa = $this->Relacionempresa->obtenerListaEmpresasRelacion($empresaId);

            $this->set(compact('empresaId', 'usuarioId', 'tipoPago', 'notaFactura', 'vendedor', 'relacionEmpresa'));
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
            		
		if (!$this->Factura->exists($id)) {
			throw new NotFoundException(__('Invalid factura'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Factura->save($this->request->data)) {
				$this->Session->setFlash(__('The factura has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The factura could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Factura.' . $this->Factura->primaryKey => $id));
			$this->request->data = $this->Factura->find('first', $options);
		}
		$clientes = $this->Factura->Cliente->find('list');
		$empresas = $this->Factura->Empresa->find('list');
		$usuarios = $this->Factura->Usuario->find('list');
		$this->set(compact('clientes', 'empresas', 'usuarios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->loadModel('Documento');
            $this->loadModel('Cargueinventario');
            $this->loadModel('Facturasdetalle');
            $this->loadModel('Cuentascliente');
            $this->loadModel('Ventarapida');
            
            $infoFact = $this->Factura->obtenerInfoFacturaPorId($id);
            $usuarioId = $this->Auth->user('id');
            
            /*se obtiene el documento de la factura*/
            $documentoId = $infoFact['Factura']['documento_id'];
            
            /*se obtiene la fecha actual*/
            $fechaActual = date('Y-m-d G:i:s');

            /*se actualiza el tipo de documento de factura de venta a factura cancelada*/
            $facturaCancelada = '3';
            if($this->Documento->actualizarTipoDocumento($documentoId,$facturaCancelada,$usuarioId,$fechaActual)){                
                
                /*Se eliminan las cuentas pendientes que se encuentren relacionadas con la factura*/
                $this->Cuentascliente->deleteAll(array('Cuentascliente.factura_id' => $id), false);
                
                /*Se eliminan los registros de ventas rapidas que se encuentren relacionadas con la factura*/
                $this->Ventarapida->deleteAll(array('Ventarapida.factura_id' => $id), false);                
                
                /*se restauran los productos de la factura*/                
                $detalleFact = $infoFact['Facturasdetalle'];
                foreach ($detalleFact as $detFact){
                    /*se obtiene el id del cargue inventario*/
                    $infoCargueInventario = $this->Cargueinventario->obtenerCargueInventarioProdDep($detFact['producto_id'], $detFact['deposito_id']);
                    if(count($infoCargueInventario) > '0'){
                        $existFinal = $infoCargueInventario['Cargueinventario']['existenciaactual'] + $detFact['cantidad'];
                        if($this->Cargueinventario->actalizarExistenciaStock($infoCargueInventario['Cargueinventario']['id'], $existFinal)){
                            $detalleId['Facturasdetalle.id'] = $detFact['id'];
                            $this->Facturasdetalle->delete($detalleId);
                        }                        
                    }else{
                        $detalleId['Facturasdetalle.id'] = $detFact['id'];
                        $this->Facturasdetalle->delete($detalleId);                        
                    }

                } 
                
                /*al finalizar la actualización del cargue de inventario y la eliminacion del detalle, se elimina la factura*/
                $this->Factura->id = $id;
                if (!$this->Factura->exists()) {
                        throw new NotFoundException(__('La factura no existe.'));
                }
                $this->request->onlyAllow('post', 'delete');
                if ($this->Factura->delete()) {
                $this->Session->setFlash(__('La factura ha sido eliminada.'));
                } else {
                        $this->Session->setFlash(__('La factura no pudo ser eliminada. Por favor, inténtelo de nuevo.'));
                }
                
                
            }else{
                $this->Session->setFlash(__('La factura no pudo ser cancelada. Por favor, inténtelo de nuevo.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
        
        public function pagofactura(){
            $posData = $this->request->data;
            $totalFacturar = $posData['valorCompra'];
            $this->set(compact('totalFacturar'));
            /*se carga el ctp para agregar los valores a pagar*/
        }
        
        public function facturarProductos(){
            $this->loadModel('Prefacturasdetalle');
            $this->loadModel('Documento');
            $this->loadModel('Cargueinventario');
            $this->loadModel('DepositosUsuario');
            $this->loadModel('Deposito');
            $this->loadModel('Detalledocumento');
            $this->loadModel('Facturasdetalle');
            $this->loadModel('Empresa');
            $this->loadModel('Ventarapida');
            $this->loadModel('Utilidade');
            $this->loadModel('Cuentascliente');
            $this->loadModel('FacturasNotafactura');
            $this->loadModel('Relacionempresa');
            
            $this->autoRender = false;
            $posData = $this->request->data;

            $datFact = $posData['Factura'];
            $datCliNuevo = $posData['Nuevo'];          
            $datVentaRapida = $posData['Rapida'];

            /*Se obtienen los datos de la empresa para obtener la ciudad de la misma y asignarla al cliente*/
            $arrEmpresa = $this->Empresa->obtenerEmpresaPorId($datFact['empresa']);
            
            /*Se valida si es un cliente registrado o un cliente nuevo para el id del cleinte*/
            if($datCliNuevo['nuevonombre'] != ""){    
                $clienteId = $this->crearClienteNuevo($datCliNuevo,$datFact['empresa'],$datFact['usuario'],$arrEmpresa['Empresa']['ciudade_id']); 
                $diasCredito = $datCliNuevo['nuevodiascredito'];
            }else if($datVentaRapida['rapidanombre'] != ""){                
                $clienteId = null;
                $diasCredito = '30';
            }else{
                $clienteId = $datFact['idcliente'];
                $diasCredito = $datFact['diascredcliente'];
            }            

            $arrIdsProd = array();
            
            /*se obtienen los ids de los detalles de la factura para obtener los productos a facturar*/
            foreach ($posData as $k => $v){
                if($k != 'Factura'){
                    $arrObtId = explode("_", $k);
                    if($arrObtId['0'] == 'cant'){
                        $arrIdsProd[] = $arrObtId['1']; 
                    }else{
                        continue;
                    }                    
                }
            }
                     
            $fechaActual = date('Y-m-d');

            /*se calcula la fecha de vencimiento de la factura si esta es de tipo credito*/
            if($datFact['tipopago'] != '2'){
                $fechaVence = $this->calcularFechaVencimientoCredito($fechaActual,$diasCredito);                
            }else{
                $fechaVence = null;
            }               
            
            /*se crea el documento con el tipo de documento factura*/
            $tipoDocumentoId = '2';
            $documentoId = $this->Documento->guardarDocumento($tipoDocumentoId,$datFact['empresa'],$datFact['usuario']);
            /*se crea el documento para la factura que se está generando*/
            
            /*se actualiza el codigo del documento ya que en mysql no se admite mas de un autoincrement*/
            $this->Documento->actualizarCodigoDocumento($documentoId);            
            
            /*se obtiene la información de la empresa relacionada si el campo fue diligenciado*/
            if($datFact['empresaRelacionada'] != ""){
                $infoEmpRelacionada = $this->Relacionempresa->obtenerInfoEmpresaRelacionada($datFact['empresaRelacionada'],$datFact['empresa']);
                if(count($infoEmpRelacionada) > '0'){
                    $datFact['empresaRelacionada'] = $infoEmpRelacionada['Relacionempresa']['id'];
                }else{
                    $datFact['empresaRelacionada'] = null;
                }
            }
            
            /*Se crea la factura*/
            $facturaId = $this->Factura->guardarfactura($clienteId,$datFact['empresa'],$datFact['vendedor'],$fechaVence,
                    $datFact['tipopago'],$datFact['pagocontado'],$datFact['pagocredito'],$documentoId,$datFact['empresaRelacionada']);
                    
            /*Se actualiza el codigo de la factura con el id de la factura ya que MySql solo acepta un autoincrement*/
            $this->Factura->actualizarCodigoFactura($facturaId);
            
            if($clienteId == "" || $clienteId == null){
                $this->Ventarapida->guardarInfoClienteVentaRapida($facturaId,$datVentaRapida['rapidanombre'],$datVentaRapida['rapidanit'],$datVentaRapida['rapidatelefono'],$datVentaRapida['rapidadireccion']);
            }
            
            /*se guarda la nota relacionada a la factura*/
            if(isset($datFact['notafactura']) && $datFact['notafactura'] != ""){
                $this->FacturasNotafactura->guardarNotaFactura($facturaId,$datFact['notafactura'],$datFact['vendedor']);
            }

            /*Se obtiene el depósito del usuario*/
            $arrDptos = $this->DepositosUsuario->obtenerDepositosUsuario($datFact['usuario']);
            $arrDatDpto = $this->Deposito->obtenerInfoDepositoPorId($arrDptos['0']['DepositosUsuario']['deposito_id']);

            
            /*Se valida si la venta se realiza con una empresa relacionada*/
            if($datFact['empresaRelacionada'] != "" && $datFact['empresaRelacionada'] != null){
                $consFact = null;
            }else{
                /*si el regimen es simplificado, se toma como consecutivo el autoincrement de la tabla factura*/
                /*si el regimen es comun, se obtiene el consecutivo del deposito y se actualiza*/
                /*id 1 = comun     id 2 = simplificado*/            
                $consFact = $this->obtenerConsecutivoFactura($arrDatDpto, $facturaId);
            }
            /* se valida si la fecha de vencimiento es diferente de null,
             de ser asi, se confirma el pago a crédito y se registra el 
             valor pendiente por cobrar al cliente */
            if($fechaVence != null){
                $depositoId = $arrDptos['0']['DepositosUsuario']['deposito_id'];
                $this->Cuentascliente->guardarCuentaPorCobrar($documentoId,$depositoId,$clienteId,$datFact['usuario'],$datFact['empresa'],$datFact['pagocredito'],$facturaId);
            }
                        
            $prefacturaId = "";
            for($i = 0; $i < count($arrIdsProd); $i++){
                /*se obtiene el detalle de la prefactura*/
                $detallePrefactura = $this->Prefacturasdetalle->obtenerPrefacturaDetalleId($arrIdsProd[$i]);

                if($prefacturaId == ""){
                    $prefacturaId = $detallePrefactura['Prefacturasdetalle']['prefactura_id'];
                }

                /*se obtienen los datos del cargueinventario*/
                $arrCrgInv = $this->Cargueinventario->obtenerInventarioId($detallePrefactura['Prefacturasdetalle']['cargueinventario_id']); 

                /*Se guarda el detalle del documento*/
                $this->Detalledocumento->guardarDetalleDocumento($arrCrgInv['Cargueinventario']['producto_id'],$arrCrgInv['Cargueinventario']['deposito_id'],
                        $depDestId = "",$arrCrgInv['Cargueinventario']['precioventa'],$detallePrefactura['Prefacturasdetalle']['cantidad'],
                        $arrCrgInv['Cargueinventario']['preciomaximo'],$arrCrgInv['Cargueinventario']['preciominimo'],
                        $detallePrefactura['Prefacturasdetalle']['costoventa'],$arrCrgInv['Cargueinventario']['proveedore_id'],
                        $datFact['tipopago'],$consFact,$documentoId);               
                
                /*Se guarda el detalle de la factura*/
                $costoTotalProd = $detallePrefactura['Prefacturasdetalle']['cantidad'] * $detallePrefactura['Prefacturasdetalle']['costoventa'];
                if($this->Facturasdetalle->guardarDetalleFactura($facturaId,$arrCrgInv['Cargueinventario']['deposito_id'],
                        $arrCrgInv['Cargueinventario']['producto_id'],$detallePrefactura['Prefacturasdetalle']['cantidad'],
                        $detallePrefactura['Prefacturasdetalle']['costoventa'],$costoTotalProd)){
                    /*se elimina el registro de prefacturadetalle*/
                    $this->eliminarDetallePrefactura($detallePrefactura['Prefacturasdetalle']['id']);                    
                }   
                
                /*Se calculan las utilidades de la venta y se guarda la utilidad del producto*/                
                $totalCosto = $detallePrefactura['Prefacturasdetalle']['cantidad'] * $arrCrgInv['Cargueinventario']['costoproducto'];
                $utilidadBruta = $costoTotalProd - $totalCosto;
                $utilidadPorcentual = $utilidadBruta / ($costoTotalProd * 100);
                $this->Utilidade->guardarUtilidadProducto($arrCrgInv['Cargueinventario']['id'], $detallePrefactura['Prefacturasdetalle']['cantidad'], 
                        $detallePrefactura['Prefacturasdetalle']['costoventa'], $utilidadBruta, $utilidadPorcentual, $arrEmpresa['Empresa']['id']);
            }
            
            /*se valida si la prefactura contien ordenes de compra*/
            $detallePrefact = $this->Prefacturasdetalle->obtenerDetallesPrefacturaPrefactId($prefacturaId);
            if(count($detallePrefact) == '0'){
                /*se elimina el registro de la prefactura que fue procesada y facturada*/
                $this->eliminarPrefactura($prefacturaId);                
            }
            echo json_encode(array('resp' => $facturaId));                       
        }
        
        public function calcularFechaVencimientoCredito($fechaActual,$diasCredito){              
            $fecha= new DateTime($fechaActual);
            $fechaVence = $fecha->add(new DateInterval('P' . $diasCredito . 'D'));            
            return $fechaVence->format('Y-m-d');
        }
        
        public function obtenerConsecutivoFactura($arrDatDpto, $facturaId){
            $this->loadModel('Deposito');
            if($arrDatDpto['Deposito']['regimene_id'] == '1'){
                $consFact = $arrDatDpto['Deposito']['numresolucionactual'];

                /*se actualiza el consecutivo de la factura consecutivodian*/
                $this->Factura->actualizarConsecutivoDianFactura($facturaId,$consFact);
                
                /*se incrementa el numero de resolucion actual y se actualiza*/
                $numResAct = $consFact + '1';
                $this->Deposito->actualizarConsecutivoFactura($arrDatDpto['Deposito']['id'], $numResAct);
            }else{
                $infoFact = $this->Factura->obtenerInfoFacturaPorId($facturaId);
                $consFact = $infoFact['Factura']['codigo'];
            }
            return $consFact;
        }
        
        public function eliminarDetallePrefactura($id){
            $this->loadModel('Prefacturasdetalle');
            $detalle['Prefacturasdetalle.id'] = $id;
            if($this->Prefacturasdetalle->delete($detalle)){
                $resp = true;
            }else{
                $resp = false;                
            }
            return $resp;
        }
        
        public function eliminarPrefactura($id){            
            $this->loadModel('Prefactura');
            $prefactura['Prefactura.id'] = $id;
            if($this->Prefactura->delete($prefactura)){
                $resp = true;
            }else{
                $resp = false;                
            }
            return $resp;            
        }
        
        public function facturacionclientenuevo(){
            $this->loadModel('Prefacturasdetalle');
            $this->loadModel('Cargueinventario');
            $this->loadModel('Prefactura');

            $this->autoRender = false;
            $posData = $this->request->data; 
            
            $cargueinventarioId = $posData['cargueinventarioId'];
            $cantidadventa = $posData['cantidadventa'];
            $precioventa = $posData['precioventa'];
            $prefacturaId = $posData['prefacturaId'];
            $usuarioId = $posData['usuarioId'];

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
            
            /*se actualiza la cantidad en stock tras la prefactura*/
            $this->Cargueinventario->actalizarExistenciaStock($cargueinventarioId, $existFinal);
            
            $detalleId = $this->Prefacturasdetalle->guardarDetallePrefactura($cantidadventa,$precioventa,$cargueinventarioId,$prefacturaId);
            if($detalleId != '0' && $detalleId != ""){
                echo json_encode(array('resp' => $detalleId, 'prefact' => $prefacturaId));
            }else{
                echo json_encode(array('resp' => $detalleId, 'prefact' => $prefacturaId));
            }
        }
        
        public function crearClienteNuevo($datCliNuevo,$empresaId,$usuarioId,$ciudadId){
            $this->loadModel('Cliente');            
            $clienteId = $this->Cliente->guardarClienteNuevo($datCliNuevo['nuevonit'],$datCliNuevo['nuevonombre'],$datCliNuevo['nuevodireccion'],
                    $datCliNuevo['nuevotelefono'],$ciudadId,$datCliNuevo['nuevopaginaweb'],$datCliNuevo['nuevoemail'],$datCliNuevo['nuevocelular'],
                    $datCliNuevo['nuevodiascredito'],$datCliNuevo['nuevolimitecredito'],$datCliNuevo['nuevocumpleanios'],$usuarioId,$estId = '1',$empresaId);
            return $clienteId;
        }
        
        public function cierrediario(){                                    
            $this->loadModel('Ventarapida');
            $this->loadModel('Cargueinventario');
            
            if(isset($this->passedArgs['Cierrediario.Fecha'])){
                $fechaCierre = $this->passedArgs['Cierrediario.Fecha'];
            }else{
                $fechaCierre = date('Y-m-d');
            }
            
            $empresaId = $this->Auth->user('empresa_id');

            /*se obtienen las facturas generadas durante la fecha actual o la seleccionada*/
            $detFacts = $this->Factura->obtenerFacturasCierreDiario($fechaCierre . ' 00:00:00', $fechaCierre . ' 23:59:59', $empresaId);
            $totalContado = 0;
            $totalCredito = 0;
            for($i = 0;$i < count($detFacts); $i++){
                
                /*si el registro de la factura no contiene 
                un cliente, lo busca en clientes de ventas rapidas*/
                if($detFacts[$i]['Factura']['cliente_id'] == ""){
                    $arrVentaRapida = $this->Ventarapida->obtenerInfoVentaFactId($detFacts[$i]['Factura']['id']);
                    $detFacts[$i]['Factura']['nombrecliente'] = $arrVentaRapida['Ventarapida']['cliente'] . " - " . $arrVentaRapida['Ventarapida']['identificacion'];
                }

                /*Aqui se debe obtener el impuesto de cada producto*/
                if(isset($detFacts[$i]['Facturasdetalle']['0'])){
	                $productoId = $detFacts[$i]['Facturasdetalle']['0']['producto_id'];
	                $depositoId = $detFacts[$i]['Facturasdetalle']['0']['deposito_id'];
	                
	                $ttalImpuestos = $this->validarImpuestoCierreDiario($productoId, $depositoId, $detFacts[$i]['Factura']['pagocontado'], $detFacts[$i]['Factura']['pagocredito']);                
	
	                $totalContado += ($detFacts[$i]['Factura']['pagocontado'] + $ttalImpuestos['pagoCont']);
	                $totalCredito += ($detFacts[$i]['Factura']['pagocredito']  + $ttalImpuestos['pagoCred']);
	
	                $detFacts[$i]['Factura']['pagocontado'] = $detFacts[$i]['Factura']['pagocontado'] + $ttalImpuestos['pagoCont'];
	                $detFacts[$i]['Factura']['pagocredito'] = $detFacts[$i]['Factura']['pagocredito'] + $ttalImpuestos['pagoCred'];
	            }                         
                }
            
            $this->set(compact('detFacts','totalContado','totalCredito','fechaCierre'));            
        }
        
        public function buscarcierre() {
            $url=array();
            $url['action'] = 'cierrediario';
            
            foreach ($this->data as $k => $v){
                foreach ($v as $kk => $vv){
                    $url[$k.'.'.$kk]=$vv;                           
                    } 
                }
            $this->redirect($url, null, true);
	}
        
        public function validarImpuestoProducto($dtFt){
            $this->loadModel('CargueinventariosImpuesto');
            $impuestoProducto = $this->CargueinventariosImpuesto->obtenerImpuestosProductoId($dtFt['Producto']['id'], $dtFt['Facturasdetalle']['deposito_id']);
            $arrImpuestos = array();
            for($i = 0; $i < count($impuestoProducto); $i ++){
                $sumImpuesto = 1 + (str_replace(",", ".", $impuestoProducto[$i]['I']['valor'])/100);
                $impuesto = str_replace(",", ".", $impuestoProducto[$i]['I']['valor'])/100;
                $arrImpuestos[$i]['decripcion'] = $impuestoProducto[$i]['I']['descripcion'];
                $arrImpuestos[$i]['valorProd'] =  round($dtFt['Facturasdetalle']['costototal']*$sumImpuesto);
                $arrImpuestos[$i]['valorImpuesto'] =  round($dtFt['Facturasdetalle']['costototal'] * $impuesto);
                $arrImpuestos['decripcion'] = $impuestoProducto[$i]['I']['descripcion'];
                $arrImpuestos['valorProd'] =  round($dtFt['Facturasdetalle']['costototal']*$sumImpuesto);
                $arrImpuestos['valorImpuesto'] =  round($dtFt['Facturasdetalle']['costototal'] * $impuesto);
                $arrImpuestos['baseIva'] = $impuestoProducto[$i]['I']['valor'];
                
            }
            return $arrImpuestos;
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
        
        
	
        public function validarImpuestoCierreDiario($productoId, $depositoId, $pagoContado, $pagoCredito){
            $this->loadModel('CargueinventariosImpuesto');           
            $impuestoProducto = $this->CargueinventariosImpuesto->obtenerImpuestosProductoId($productoId, $depositoId);
            $totalImpuestoContado = 0;
            $totalImpuestoCredito = 0;            
            
            /*se obtiene el valor agregado sobre el pago de contado y a credito*/
            for($i = 0; $i < count($impuestoProducto); $i ++){              
                $impuesto = str_replace(",", ".", $impuestoProducto[$i]['I']['valor'])/100;
                $totalImpuestoContado += $pagoContado * $impuesto; 
                $totalImpuestoCredito += $pagoCredito * $impuesto;                
            }
            
            $totalImpuesto['pagoCont'] = $totalImpuestoContado;
            $totalImpuesto['pagoCred'] = $totalImpuestoCredito;
            
            return $totalImpuesto;
        }          
        
}