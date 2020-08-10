<?php
App::uses('AppModel', 'Model');
/**
 * Cliente Model
 *
 * @property Ciudade $Ciudade
 * @property Usuario $Usuario
 * @property Estado $Estado
 * @property Anotacione $Anotacione
 * @property Deposito $Deposito
 */
class Cliente extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ciudade_id' => array(
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
		'estado_id' => array(
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
		'Ciudade' => array(
			'className' => 'Ciudade',
			'foreignKey' => 'ciudade_id',
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
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
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
		'Anotacione' => array(
			'className' => 'Anotacione',
			'foreignKey' => 'cliente_id',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Deposito' => array(
			'className' => 'Deposito',
			'joinTable' => 'depositos_clientes',
			'foreignKey' => 'cliente_id',
			'associationForeignKey' => 'deposito_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
        
        public function obtenerDatosCliente($nombre,$empresaId){
            $arrDatosCliente = $this->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        'LOWER(Cliente.nombre) LIKE' => '%'. $nombre . '%',
                        'LOWER(Cliente.nit) LIKE' => '%'. $nombre . '%'
                    ),
                    'Cliente.empresa_id' => $empresaId                    
                ), 
                'order' => 'Cliente.nombre',
                'recursive' => '-1'));

            return $arrDatosCliente;
        }
        
        public function obtenerInformacionCliente($clienteId){
            $arrInfoCliente = $this->find('first', array('conditions' => array('Cliente.id' => $clienteId), 'recursive' => '0'));
            return $arrInfoCliente;
        }
        
        public function guardarClienteNuevo($nit,$nombre,$dir,$tel,$ciudad,$pagweb,$email,$cel,$diasCred,$limCred,$cumple,$usrId,$estId,$empId){
            $data = array();
            
            $cliente = new Cliente();
            
            $data['nit'] = $nit;
            $data['nombre'] = $nombre;
            $data['direccion'] = $dir;
            $data['telefono'] = $tel;
            $data['ciudade_id'] = $ciudad;
            $data['paginaweb'] = $pagweb;
            $data['email'] = $email;
            $data['celular'] = $cel;            
            $data['diascredito'] = $diasCred;
            $data['limitecredito'] = $limCred;
            $data['cumpleanios'] = $cumple;
            $data['usuario_id'] = $usrId;
            $data['estado_id'] = $estId;
            $data['empresa_id'] = $empId;
            
            if($cliente->save($data)){
                return $cliente->id;
            }else{
                return false;
            }                    
        }
        
        public function obtenerClienteEmpresa($empresaId){
            $listClientes = $this->find('list', array('conditions' => array('Cliente.empresa_id' => $empresaId), 'recursive' => '-1', 'order' => 'Cliente.nombre'));
            return $listClientes;
        }

}
