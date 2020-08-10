<?php
App::uses('AppModel', 'Model');
/**
 * Prefacturasdetalle Model
 *
 * @property Cargueinventario $Cargueinventario
 * @property Prefactura $Prefactura
 */
class Prefacturasdetalle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'cantidad' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cargueinventario_id' => array(
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
		'Cargueinventario' => array(
			'className' => 'Cargueinventario',
			'foreignKey' => 'cargueinventario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Prefactura' => array(
			'className' => 'Prefactura',
			'foreignKey' => 'prefactura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function guardarDetallePrefactura($cantidadventa,$precioventa,$cargueinventarioId,$prefactId){
            $data = array();
            $prefacturadetalle = new Prefacturasdetalle();
            
            $data['cantidad'] = $cantidadventa;
            $data['costoventa'] = $precioventa;
            $data['cargueinventario_id'] = $cargueinventarioId;
            $data['prefactura_id'] = $prefactId;
            
            if($prefacturadetalle->save($data)){                
                return $prefacturadetalle->id;
            }else{
                return '0';
            }
        }
        
        public function obtenerPrefacturaDetalleId($preFactDetId){
            $arrPreFDet = $this->find('first', array('conditions' => array('Prefacturasdetalle.id' => $preFactDetId), 'recursive' => '-1'));
            return $arrPreFDet;
        }
        
        public function obtenerDetallesPrefacturaPrefactId($prefacturaId){
            $arrDetPreFact = $this->find('first', array('conditions' => array('Prefacturasdetalle.prefactura_id' => $prefacturaId), 'recursive' => '-1'));
            return $arrDetPreFact;
        }
        
        public function obtenerProductosPrefacturaPrefactId($prefacturaId){
            $arrDetPreFact = $this->find('all', array('conditions' => array('Prefacturasdetalle.prefactura_id' => $prefacturaId), 'recursive' => '0'));
            return $arrDetPreFact;
        }
}
