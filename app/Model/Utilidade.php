<?php
App::uses('AppModel', 'Model');
/**
 * Utilidade Model
 *
 * @property Cargueinventario $Cargueinventario
 * @property Empresa $Empresa
 */
class Utilidade extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'Cargueinventario' => array(
			'className' => 'Cargueinventario',
			'foreignKey' => 'cargueinventario_id',
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
        
        public function guardarUtilidadProducto($crgInvId,$cantidadProducto,$valorVenta,$utilidadBruta,$utilidadPorcentual,$empresaId){
            $data = array();
            $utilidad = new Utilidade();
            
            $data['cargueinventario_id'] = $crgInvId;
            $data['cantidad'] = $cantidadProducto;
            $data['precioventa'] = $valorVenta;
            $data['utilidadbruta'] = $utilidadBruta;
            $data['utilidadporcentual'] = $utilidadPorcentual;
            $data['empresa_id'] = $empresaId;

            if($utilidad->save($data)){
                return true;                
            }else{
                return false;
            }
        }
        
        public function obtenerUtilidadesPorEmpresa($fechaInicio,$fechaFin,$empresaId){
            $utilidades = $this->find('all', array('conditions' => array('Utilidade.empresa_id' => $empresaId, 'Utilidade.created BETWEEN ? AND ?' => array($fechaInicio, $fechaFin)), 'recursive' => '0'));
            return $utilidades;
        }
}
