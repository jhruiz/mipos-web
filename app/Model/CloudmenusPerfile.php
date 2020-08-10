<?php
App::uses('AppModel', 'Model');
/**
 * CloudmenusPerfile Model
 *
 * @property Cloudmenu $Cloudmenu
 * @property Perfile $Perfile
 */
class CloudmenusPerfile extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'cloudmenu_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'perfile_id' => array(
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
		'Cloudmenu' => array(
			'className' => 'Cloudmenu',
			'foreignKey' => 'cloudmenu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Perfile' => array(
			'className' => 'Perfile',
			'foreignKey' => 'perfile_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
/**
 * Se obtienen todos los menus que se han relacionado al usuario para la navegacion en la aplicacion
 * en orden por el campo "orden"
 *
 * @var array
 */        
        public function obtenerMenusPorPerfilId($perfilId){
            $arr_join = array(); 
            array_push($arr_join, array(
                'table' => 'cloudmenus', 
                'alias' => 'C', 
                'type' => 'INNER',
                'conditions' => array(
                    'C.id=CloudmenusPerfile.cloudmenu_id')
                
            ));                      
            
            $arrMenuPerfil = $this->find('all', array(
                'joins' => $arr_join,
                'conditions' => array(
                    'CloudmenusPerfile.perfile_id' => $perfilId), 
                'order' => 'C.orden', 
                'recursive' => 0)
                    );
            return $arrMenuPerfil;
        }
}
