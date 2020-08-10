<?php
App::uses('AppController', 'Controller');
/**
 * Cuentasclientes Controller
 *
 * @property Cuentascliente $Cuentascliente
 * @property PaginatorComponent $Paginator
 */
class CuentasclientesController extends AppController {

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
            $this->loadModel('Ventarapida');
            $empresaId = $this->Auth->user('empresa_id');
            $paginate['Cuentascliente.empresa_id'] = $empresaId;
            $this->Cuentascliente->recursive = 0;
            $cuentasclientes = $this->Paginator->paginate('Cuentascliente',$paginate);
            $fechaActual = date('Y-m-d');
            $costoTotal = 0;
            $costoVencido = 0;
            $costoVigente = 0;
            for($i = 0; $i < count($cuentasclientes); $i++){
                if($cuentasclientes[$i]['Cuentascliente']['cliente_id'] != ""){
                    $cuentasclientes[$i]['Cuentascliente']['fechalimitepago'] = $this->sumarDiasFecha($cuentasclientes[$i]['Cuentascliente']['created'],$cuentasclientes[$i]['Cliente']['diascredito']);
                }else{
                    $infoVentaRapida = $this->Ventarapida->obtenerInfoVentaFactId($cuentasclientes[$i]['Factura']['id']);

                    if(count($infoVentaRapida) > 0){
                        $cuentasclientes[$i]['Cliente']['nombre'] = $infoVentaRapida['Ventarapida']['cliente'];
                    }else{
                        $cuentasclientes[$i]['Cliente']['nombre'] = "";
                    }
                    $cuentasclientes[$i]['Cuentascliente']['fechalimitepago'] = "";
                }
           
                $diff = $this->diffFechas($fechaActual, $cuentasclientes[$i]['Cuentascliente']['fechalimitepago']);                
                        
                if($cuentasclientes[$i]['Cuentascliente']['totalobligacion'] > $cuentasclientes[$i]['Cliente']['limitecredito']){                    
                    $cuentasclientes[$i]['Cuentascliente']['limitecredito'] = 'text-danger';
                }else{
                    $cuentasclientes[$i]['Cuentascliente']['limitecredito'] = 'text';                    
                }                
                    
                    
                if($diff <= '0'){
                    $cuentasclientes[$i]['Cuentascliente']['color'] = 'danger';
                    $cuentasclientes[$i]['Cuentascliente']['diasvencido'] = $diff;
                    $costoVencido += $cuentasclientes[$i]['Cuentascliente']['totalobligacion'];
                }else{
                    $cuentasclientes[$i]['Cuentascliente']['color'] = 'success';
                    $cuentasclientes[$i]['Cuentascliente']['diasvencido'] = $diff;
                    $costoVigente += $cuentasclientes[$i]['Cuentascliente']['totalobligacion'];
                }
            }
            $costoTotal = $costoVencido + $costoVigente;
            $this->set(compact('cuentasclientes', 'costoVencido', 'costoVigente', 'costoTotal'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cuentascliente->exists($id)) {
			throw new NotFoundException(__('Invalid cuentascliente'));
		}
		$options = array('conditions' => array('Cuentascliente.' . $this->Cuentascliente->primaryKey => $id));
		$this->set('cuentascliente', $this->Cuentascliente->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cuentascliente->create();
			if ($this->Cuentascliente->save($this->request->data)) {
				$this->Session->setFlash(__('The cuentascliente has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuentascliente could not be saved. Please, try again.'));
			}
		}
		$documentos = $this->Cuentascliente->Documento->find('list');
		$depositos = $this->Cuentascliente->Deposito->find('list');
		$clientes = $this->Cuentascliente->Cliente->find('list');
		$usuarios = $this->Cuentascliente->Usuario->find('list');
		$empresas = $this->Cuentascliente->Empresa->find('list');
		$facturas = $this->Cuentascliente->Factura->find('list');
		$this->set(compact('documentos', 'depositos', 'clientes', 'usuarios', 'empresas', 'facturas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cuentascliente->exists($id)) {
			throw new NotFoundException(__('Invalid cuentascliente'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cuentascliente->save($this->request->data)) {
				$this->Session->setFlash(__('The cuentascliente has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuentascliente could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cuentascliente.' . $this->Cuentascliente->primaryKey => $id));
			$this->request->data = $this->Cuentascliente->find('first', $options);
		}
		$documentos = $this->Cuentascliente->Documento->find('list');
		$depositos = $this->Cuentascliente->Deposito->find('list');
		$clientes = $this->Cuentascliente->Cliente->find('list');
		$usuarios = $this->Cuentascliente->Usuario->find('list');
		$empresas = $this->Cuentascliente->Empresa->find('list');
		$facturas = $this->Cuentascliente->Factura->find('list');
		$this->set(compact('documentos', 'depositos', 'clientes', 'usuarios', 'empresas', 'facturas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cuentascliente->id = $id;
		if (!$this->Cuentascliente->exists()) {
			throw new NotFoundException(__('Invalid cuentascliente'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cuentascliente->delete()) {
			$this->Session->setFlash(__('The cuentascliente has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cuentascliente could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function sumarDiasFecha($fecha,$dias){
            $fechaNew = new DateTime($fecha);
            $fechaNew->add(new DateInterval('P' . $dias . 'D'));
            $fechaFin = $fechaNew->format('Y-m-d');
            return $fechaFin;          
        }
        
        public function diffFechas($fechaLimite, $fechaActual){
            $datetime1 = date_create($fechaLimite);
            $datetime2 = date_create($fechaActual);
            $interval = date_diff($datetime1, $datetime2);
            $dias = $interval->format('%R%a');
            return $dias;            
        }     
        
        public function obtenercuentacliente(){
            $this->loadModel('Cuenta');
            $posData = $this->request->data;
            $empresaId = $this->Auth->user('empresa_id');
            $cuentaId = $posData['pagoId'];
            
            //se obtienen los datos de la cuenta que se desea pagar
            $datosCuentaPendiente = $this->Cuentascliente->obtenerDatosCuentaPendienteId($cuentaId);

            //se obtienen las cuentas de la empresa
            $listaCuentas = $this->Cuenta->obtenerCuentasEmpresa($empresaId);
            $this->set(compact('datosCuentaPendiente', 'listaCuentas', 'cuentaId'));
        }
        
        public function pagarcuentacliente(){
            $this->loadModel('Cuenta');
            $this->autoRender = false;
            $posData = $this->request->data;
            
            $ttalPago = $posData['ttalPago'];
            $cuentaId = $posData['cuenta'];
            $cuentaPendienteId = $posData['cuentapendiente'];
            $resp = true;
            //Se obtiene la informacion de la cuenta por cobrar
            $datosCuentaPendiente = $this->Cuentascliente->obtenerDatosCuentaPendienteId($cuentaPendienteId);
            
            //Se obtiene la informacion de la cuenta a la que se sumara el pago
            $datosCuenta = $this->Cuenta->obtenerDatosCuentaId($cuentaId);
            //Se resta la cantidad paga de la cuenta pendiente
            $saldoCuentaPendiente = $datosCuentaPendiente['Cuentascliente']['totalobligacion'] - $ttalPago;
            if($this->Cuentascliente->actualizarCuentaCliente($cuentaPendienteId,$saldoCuentaPendiente)){
                $nuevoSaldoCuenta = $datosCuenta['Cuenta']['saldo'] + $ttalPago;
                $this->Cuenta->actualizarSaldoCuenta($cuentaId, $nuevoSaldoCuenta);
            }else{
                $resp = false;
            }
            echo json_encode(array('resp' => $resp));
        } 
        
        public function eliminarcuentacliente(){
            $this->autoRender = false;
            $posData = $this->request->data;
            $posData['id'];
            $resp = $this->Cuentascliente->eliminarCuenta($posData['id']);
            echo $resp;
        }       
}
