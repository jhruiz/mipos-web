<?php
App::uses('AppModel', 'Model');
/**
 * Cuentascliente Model
 *
 * @property Documento $Documento
 * @property Deposito $Deposito
 * @property Cliente $Cliente
 * @property Usuario $Usuario
 * @property Empresa $Empresa
 * @property Factura $Factura
 */
class Cuentascliente extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'documento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'deposito_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'usuario_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'empresa_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'factura_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Deposito' => array(
			'className' => 'Deposito',
			'foreignKey' => 'deposito_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Factura' => array(
			'className' => 'Factura',
			'foreignKey' => 'factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function guardarCuentaPorCobrar($documentoId,$depositoId,$clienteId,$usuarioId,$empresaId,$total,$facturaId){
            $data = array();
            $cuentasclientes = new Cuentascliente();
            
            $data['documento_id'] = $documentoId;
            $data['deposito_id'] = $depositoId;
            $data['cliente_id'] = $clienteId;
            $data['usuario_id'] = $usuarioId;
            $data['empresa_id'] = $empresaId;
            $data['totalobligacion'] = $total;
            $data['factura_id'] = $facturaId;
            
            if($cuentasclientes->save($data)){
                return true;
            }else{
                return false;
            }           
        }
        
        public function obtenerDatosCuentaPendienteId($cuentaId){
            $cuentaPendiente = $this->find('first', array('conditions' => array('Cuentascliente.id' => $cuentaId), 'recursive' => '-1'));
            return $cuentaPendiente;
        }
        
        public function actualizarCuentaCliente($cuentaPendienteId,$saldoCuentaPendiente){
            $cuentaCliente = new Cuentascliente();            
            $data = array();
            $data['id'] = $cuentaPendienteId;
            $data['totalobligacion'] = $saldoCuentaPendiente;
            
            if($cuentaCliente->save($data)){
                return true;
            }else{
                return false;
            }            
        }
        
        public function obtenerCarteraCliente($clienteId){
            $arrCuentaCliente = $this->find('all', array('conditions' => array('Cuentascliente.cliente_id' => $clienteId), 'recursive' => '-1'));
            return $arrCuentaCliente;
        }
        
        public function eliminarCuenta($id){
            if($this->deleteAll(['Cuentascliente.id' => $id])){
                return true;
            }else{
                return false;
            }
        }
}
