<?php
/**
 * FacturasNotafacturaFixture
 *
 */
class FacturasNotafacturaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'facturas_notafacturas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'factura_id' => array('type' => 'integer', 'null' => false),
		'notafactura_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
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
			'notafactura_id' => 1,
			'usuario_id' => 1,
			'created' => '2017-01-22 20:34:52'
		),
	);

}
