<?php
/**
 * CuentasclienteFixture
 *
 */
class CuentasclienteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'cuentasclientes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'documento_id' => array('type' => 'integer', 'null' => false),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'cliente_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'totalobligacion' => array('type' => 'string', 'null' => true, 'length' => 100),
		'factura_id' => array('type' => 'integer', 'null' => false),
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
			'documento_id' => 1,
			'deposito_id' => 1,
			'cliente_id' => 1,
			'created' => '2017-01-03 21:53:00',
			'usuario_id' => 1,
			'empresa_id' => 1,
			'totalobligacion' => 'Lorem ipsum dolor sit amet',
			'factura_id' => 1
		),
	);

}
