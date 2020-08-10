<?php
App::uses('AppModel', 'Model');
/**
 * Factura Model
 *
 * @property Cliente $Cliente
 * @property Empresa $Empresa
 * @property Usuario $Usuario
 * @property Tipopago $Tipopago
 * @property Facturasdetalle $Facturasdetalle
 */
class Factura extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'codigo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
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
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tipopago' => array(
			'className' => 'Tipopago',
			'foreignKey' => 'tipopago_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Facturasdetalle' => array(
			'className' => 'Facturasdetalle',
			'foreignKey' => 'factura_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		), 
		'FacturasNotafactura' => array(
			'className' => 'FacturasNotafactura',
			'foreignKey' => 'factura_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)            
	);
       
        
        public function guardarfactura($clienteId,$empresaId,$usuarioId,$fechaVence,$tipoPagoId,$pagoContado,$pagoCredito,$documentoId,$empRelacionada){
            $data = array();
            $factura = new Factura();

            if($clienteId != "" && $clienteId != null){
                $data['cliente_id'] = $clienteId;
            }            
            
            if($empRelacionada == ""){
                $data['empresa_id'] = $empresaId;
            }else{
                $data['relacionempresa'] = $empRelacionada;
            }
            
            $data['usuario_id'] = $usuarioId;
            $data['fechavence'] = $fechaVence;            
            $data['tipopago_id'] = $tipoPagoId;
            $data['pagocontado'] = $pagoContado;
            $data['pagocredito'] = $pagoCredito;
            $data['documento_id'] = $documentoId;
            
            if($factura->save($data)){                
                return $factura->id;
            }else{
                return '0';
            }
        } 
        
        public function obtenerInfoFacturaPorId($facturaId){
            $infoFact = $this->find('first', array('conditions' => array('Factura.id' => $facturaId), 'recursive' => '0'));
            return $infoFact;
        }
        
        public function actualizarConsecutivoDianFactura($facturaId,$consFact){
            $data = array();
            $factura = new Factura();
            
            $data['id'] = $facturaId;
            $data['consecutivodian'] = $consFact;
            
            if($factura->save($data)){
                return true;
            }else{
                return false;
            }
        }          
        
        public function obtenerFacturasCierreDiario($fechaInicio,$fechaFin,$empresaId){
            $detFact = $this->find('all', array(
                'conditions' => array(
                    'Factura.created BETWEEN ? AND ?' => array(
                        $fechaInicio,$fechaFin
                    ),
                    'Factura.empresa_id' => $empresaId,
                    ),
                'order' => 'Factura.created',
                'recursive' => '0'
                ));
            return $detFact;
        }
        
        public function actualizarCodigoFactura($facturaId){
            $data = array();
            $factura = new Factura();
            
            $data['id'] = $facturaId;
            $data['codigo'] = $facturaId;
            
            if($factura->save($data)){
                return true;
            }else{
                return false;
            }
        }
}
