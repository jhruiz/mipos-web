<?php
/**
 * VentarapidaFixture
 *
 */
class VentarapidaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'ventarapida_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'factura_id' => array('type' => 'integer', 'null' => false),
		'cliente' => array('type' => 'string', 'null' => true, 'length' => 200),
		'identificacion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'telefono' => array('type' => 'string', 'null' => true, 'length' => 200),
		'direccion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'created' => array('type' => 'datetime', 'null' => true),
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
			'cliente' => 'Lorem ipsum dolor sit amet',
			'identificacion' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-12-10 11:14:00'
		),
	);

}
