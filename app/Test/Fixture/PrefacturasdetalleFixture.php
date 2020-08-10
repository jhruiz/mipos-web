<?php
/**
 * PrefacturasdetalleFixture
 *
 */
class PrefacturasdetalleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'prefacturasdetalles_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'cantidad' => array('type' => 'integer', 'null' => false),
		'costoventa' => array('type' => 'string', 'null' => true, 'length' => 100),
		'cargueinventario_id' => array('type' => 'integer', 'null' => false),
		'prefactura_id' => array('type' => 'integer', 'null' => true),
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
			'cantidad' => 1,
			'costoventa' => 'Lorem ipsum dolor sit amet',
			'cargueinventario_id' => 1,
			'prefactura_id' => 1
		),
	);

}
