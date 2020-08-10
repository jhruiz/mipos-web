<?php
App::uses('AppModel', 'Model');
/**
 * Cuentaspendiente Model
 *
 * @property Documento $Documento
 * @property Producto $Producto
 * @property Deposito $Deposito
 * @property Proveedore $Proveedore
 * @property Usuario $Usuario
 */
class Cuentaspendiente extends AppModel {

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
		'producto_id' => array(
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
		'Producto' => array(
			'className' => 'Producto',
			'foreignKey' => 'producto_id',
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
		'Proveedore' => array(
			'className' => 'Proveedore',
			'foreignKey' => 'proveedore_id',
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
		)            
	);
        
        public function guardarCuentasPendientes($dctoId,$pdrId,$dptoId,$costProd,$cantidad,$provId,$numFact,$usrId,$emprId,$ttOblig){
            $data=array();                        
              
            $cuentaspendientes = new Cuentaspendiente();                        
            
            $data['documento_id']=$dctoId;
            $data['producto_id']=$pdrId;
            $data['deposito_id']=$dptoId;            
            $data['costoproducto']=$costProd;
            $data['cantidad']=$cantidad;
            $data['proveedore_id']=$provId;            
            $data['numerofactura']=$numFact;
            $data['usuario_id']=$usrId;   
            $data['empresa_id']=$emprId;
            $data['totalobligacion']=$ttOblig;
            
            if($cuentaspendientes->save($data)){
                return true;
            }else{
                return false;
            }            
        }
        
        public function obtenerCuentasPendientesEmpresa($empresaId){
            $ctasPendientes = $this->find('all', array('conditions' => array('Cuentaspendiente.empresa_id' => $empresaId),'recursive' => '-1'));
            return $ctasPendientes;
        }
        
        public function obtenerCuentaPendienteId($cuentaId){
            $ctasPendiente = $this->find('first', array('conditions' => array('Cuentaspendiente.id' => $cuentaId), 'recursive' => '-1'));
            return $ctasPendiente;
        }
        
        public function actualizarCuentaPendiente($cuentaPendienteId,$saldoCuentaPendiente){
            $cuentaPendiente = new Cuentaspendiente();            
            $data = array();
            $data['id'] = $cuentaPendienteId;
            $data['totalobligacion'] = $saldoCuentaPendiente;
            
            if($cuentaPendiente->save($data)){
                return true;
            }else{
                return false;
            }
        }
        
        public function eliminarCuentaPendiente($id){
            if($this->deleteAll(['Cuentaspendiente.id' => $id])){
                return true;
            }else{
                return false;
            }            
        }
}
