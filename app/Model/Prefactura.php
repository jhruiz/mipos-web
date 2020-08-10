<?php
App::uses('AppModel', 'Model');
/**
 * Prefactura Model
 *
 * @property Usuario $Usuario
 * @property Cliente $Cliente
 * @property Prefacturasdetalle $Prefacturasdetalle
 */
class Prefactura extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'cliente_id' => array(
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
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Prefacturasdetalle' => array(
			'className' => 'Prefacturasdetalle',
			'foreignKey' => 'prefactura_id',
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
        
        public function guardarPrefactura($usuarioId,$clienteId){
            $data = array();
            
            $prefactura = new Prefactura();
            
            $data['usuario_id'] = $usuarioId;
            if($clienteId != "" && $clienteId != NULL){
                $data['cliente_id'] = $clienteId;
            }
            if($prefactura->save($data)){                
                return $prefactura->id;
            }else{
                return '0';
            }
        }
        
        public function obtenerPrefacturaId($usuarioId,$clienteId){
            $arrPrefactura = $this->find('first', array('conditions' => array('Prefactura.usuario_id' => $usuarioId, 'Prefactura.cliente_id' => $clienteId), 'recursive' => '-1'));
            return $arrPrefactura;
        }

}
