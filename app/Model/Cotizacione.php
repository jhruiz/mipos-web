<?php
App::uses('AppModel', 'Model');
/**
 * Cotizacione Model
 *
 * @property Empresa $Empresa
 * @property Usuario $Usuario
 * @property Cargueinventario $Cargueinventario
 */
class Cotizacione extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
		'Cargueinventario' => array(
			'className' => 'Cargueinventario',
			'foreignKey' => 'cargueinventario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function guardarCotizacion($empresaId, $usuarioId, $cantidadventa, $precioventa, $cargueinventarioId, $valorImpuesto, $nombreCliente, $identCliente, $FechaVencCot) {
            $data = array();                        
              
            $cotizacion = new Cotizacione();                        
            
            $data['empresa_id']=$empresaId;
            $data['usuario_id']=$usuarioId;
            $data['cargueinventario_id']=$cargueinventarioId;
            $data['cantidad']=$cantidadventa;
            $data['valorunitario']=$precioventa;
            $data['valoriva']=$valorImpuesto;
            $data['nombrecliente']=$nombreCliente;
            $data['identificacioncliente']=$identCliente;
            $data['validezcotizacion']=$FechaVencCot;                                                                                    
            
            if($cotizacion->save($data)){
                return $cotizacion->id;
            }else{
                return 0;
            }  
	}
	
	public function obtenerSumaTotalImpuestos($usuarioId){
	    $sum = $this->find('all', array(
	    'conditions' => array(
	    'Cotizacione.usuario_id' => $usuarioId),
	    'fields' => array('sum(Cotizacione.valoriva) as total_sum'
	            ),
	    'recursive' => '-1'
	        )
	    );
	    
	    if(isset($sum['0']['0'])){
	        return $sum['0']['0'];
	    }else{
	        return '0';
	    }	    
	}
	
	public function obtenerSumaTotalProductos($usuarioId){
	
	    $sum = $this->find('all', array(
	    'conditions' => array(
	            'Cotizacione.usuario_id' => $usuarioId
	        ),
	    'fields' => array(
	            'sum(Cotizacione.valorunitario * Cotizacione.cantidad) as total_val'
	        ),
	    'recursive' => '-1'
	    ));
	
	    if(isset($sum['0']['0'])){
	        return $sum['0']['0'];
	    }else{
	        return '0';
	    }		
	}
}
