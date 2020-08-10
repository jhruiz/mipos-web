<?php
App::uses('AppModel', 'Model');
/**
 * Gasto Model
 *
 * @property Usuario $Usuario
 * @property Empresa $Empresa
 * @property Cuenta $Cuenta
 */
class Gasto extends AppModel {

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
		'cuenta_id' => array(
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
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cuenta' => array(
			'className' => 'Cuenta',
			'foreignKey' => 'cuenta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
