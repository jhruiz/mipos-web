<?php
App::uses('AppModel', 'Model');
/**
 * Cargueinventario Model
 *
 * @property Producto $Producto
 * @property Deposito $Deposito
 * @property Usuario $Usuario
 * @property Estado $Estado
 * @property Proveedore $Proveedore
 * @property Tipopago $Tipopago
 */
class Cargueinventario extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		),
		'Proveedore' => array(
			'className' => 'Proveedore',
			'foreignKey' => 'proveedore_id',
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
        
        
        public function guardarCargueInventario($prodId,$deptoId,$costProd,$existAct,$prcMax,$prcMin,$prcVenta,$usrId,$estId,$provId,$tipPag,$numFact,$empId){
            $data=array();                        
              
            $cargueinventario = new Cargueinventario();                        
            
            $data['producto_id']=$prodId;
            $data['deposito_id']=$deptoId;
            $data['costoproducto']=$costProd;
            $data['existenciaactual']=$existAct;
            $data['preciomaximo']=$prcMax;               
            $data['preciominimo']=$prcMin;
            $data['precioventa']=$prcVenta;
            $data['usuario_id']=$usrId;
            $data['estado_id']=$estId;
            $data['proveedore_id']=$provId;
            $data['tipopago_id']=$tipPag;            
            $data['numerofactura']=$numFact;   
            $data['empresa_id']=$empId;
            
            if($cargueinventario->save($data)){
                return true;
            }else{
                return false;
            }              
        }
        
        public function obtenerProductoPorId($productoId){
            $infoProducto = $this->find('first', array('conditions' => array('Cargueinventario.producto_id' => $productoId), 'recursive' => '-1'));
            return $infoProducto;            
        }
        
        public function obtenerProductosStock($depositosIdx, $descripcionProd){            
            $arr_join = array(); 
            array_push($arr_join, array(
                'table' => 'productos', 
                'alias' => 'P', 
                'type' => 'INNER',
                'conditions' => array(
                    'P.id=Cargueinventario.producto_id',
                    'OR' => array(
                        'LOWER(P.descripcion) LIKE' => '%'. strtolower($descripcionProd) . '%',
                        'P.codigo LIKE' => '%'. $descripcionProd . '%'
                    ),                    
                    )                
            ));
            
            $infoInventario = $this->find('all', array(
                'joins' => $arr_join,                  
                'conditions' => array(
                    'Cargueinventario.deposito_id' => $depositosIdx
                    ),
                'recursive' => '0'                
                ));            
            
            return $infoInventario;
        }
        
        
        public function obtenerProductoStock($productoId){
            $arr_join = array(); 
            
            array_push($arr_join, array(
                'table' => 'productos', 
                'alias' => 'P', 
                'type' => 'INNER',
                'conditions' => array(
                    'P.id=Cargueinventario.producto_id',
                    'P.id' => $productoId
                    )
                
            ));           
            
            $infoInventario = $this->find('first', array(
                'joins' => $arr_join,                  
                'recursive' => '0'                
                ));            
            
            return $infoInventario;            
        }
        
        public function obtenerInventarioId($id){
            $arrInventario = $this->find('first', array('conditions' => array('Cargueinventario.id' => $id), 'recursive' => '-1'));
            return $arrInventario;
        }
        
        public function obtenerCargueInventario($dataFilter){
            $inventario = $this->find('all', array('conditions' => array($dataFilter), 'recursive' => '0'));
            return $inventario;
        }
        
        public function actalizarExistenciaStock($cargueinventarioId, $existFinal){
            $data = array();
            
            $cargueInv = new Cargueinventario();
            
            $data['id'] = $cargueinventarioId;
            $data['existenciaactual'] = $existFinal;
            
            if($cargueInv->save($data)){
                return true;
            }else{
                return false;
            }
        }
        
        public function obtenerCargueInventarioProdDep($productoId, $depositoId){
            $arrCargueInventario = $this->find('first', array(
                'conditions' => array(
                    'Cargueinventario.producto_id' => $productoId, 
                    'Cargueinventario.deposito_id' => $depositoId
                    ),
                'recursive' => '0'));
            return $arrCargueInventario;
        }      
        
        public function obtenerProductoPorIdDeposito($productoId,$depositoId){
            $infoProducto = $this->find('first', array('conditions' => array(
                'Cargueinventario.producto_id' => $productoId, 
                'Cargueinventario.deposito_id' => $depositoId
                    ), 
                'recursive' => '-1'));
            return $infoProducto;            
        }        
}
