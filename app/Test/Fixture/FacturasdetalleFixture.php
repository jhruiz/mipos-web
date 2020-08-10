<?php
/**
 * FacturasdetalleFixture
 *
 */
class FacturasdetalleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'facturasdetalles_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'factura_id' => array('type' => 'integer', 'null' => false),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'producto_id' => array('type' => 'integer', 'null' => false),
		'cantidad' => array('type' => 'integer', 'null' => false),
		'costoventa' => array('type' => 'string', 'null' => true, 'length' => 100),
		'costototal' => array('type' => 'string', 'null' => true, 'length' => 100),
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
			'factura_id' => 1,
			'deposito_id' => 1,
			'producto_id' => 1,
			'cantidad' => 1,
			'costoventa' => 'Lorem ipsum dolor sit amet',
			'costototal' => 'Lorem ipsum dolor sit amet'
		),
	);

}
