<?php
/**
 * CuentaspendienteFixture
 *
 */
class CuentaspendienteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'cuentaspendientes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'documento_id' => array('type' => 'integer', 'null' => false),
		'producto_id' => array('type' => 'integer', 'null' => false),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'costoproducto' => array('type' => 'string', 'null' => true, 'length' => 100),
		'cantidad' => array('type' => 'integer', 'null' => true),
		'proveedore_id' => array('type' => 'integer', 'null' => true),
		'numerofactura' => array('type' => 'string', 'null' => true, 'length' => 150),
		'created' => array('type' => 'datetime', 'null' => true),
		'usuario_id' => array('type' => 'integer', 'null' => false),
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
			'producto_id' => 1,
			'deposito_id' => 1,
			'costoproducto' => 'Lorem ipsum dolor sit amet',
			'cantidad' => 1,
			'proveedore_id' => 1,
			'numerofactura' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-11-30 21:30:13',
			'usuario_id' => 1
		),
	);

}
