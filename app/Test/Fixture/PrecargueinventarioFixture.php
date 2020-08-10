<?php
/**
 * PrecargueinventarioFixture
 *
 */
class PrecargueinventarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'precargueinventarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'costoproducto' => array('type' => 'string', 'null' => true, 'length' => 100),
		'cantidad' => array('type' => 'integer', 'null' => true),
		'preciomaximo' => array('type' => 'string', 'null' => true, 'length' => 100),
		'preciominimo' => array('type' => 'string', 'null' => true, 'length' => 100),
		'precioventa' => array('type' => 'string', 'null' => true, 'length' => 100),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'proveedore_id' => array('type' => 'integer', 'null' => true),
		'tipopago_id' => array('type' => 'integer', 'null' => true),
		'numerofactura' => array('type' => 'string', 'null' => true, 'length' => 150),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'producto_id' => 1,
			'deposito_id' => 1,
			'costoproducto' => 'Lorem ipsum dolor sit amet',
			'cantidad' => 1,
			'preciomaximo' => 'Lorem ipsum dolor sit amet',
			'preciominimo' => 'Lorem ipsum dolor sit amet',
			'precioventa' => 'Lorem ipsum dolor sit amet',
			'usuario_id' => 1,
			'estado_id' => 1,
			'proveedore_id' => 1,
			'tipopago_id' => 1,
			'numerofactura' => 'Lorem ipsum dolor sit amet'
		),
	);

}
