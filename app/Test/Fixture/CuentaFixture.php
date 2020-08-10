<?php
/**
 * CuentaFixture
 *
 */
class CuentaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'cuentas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 400),
		'numerocuenta' => array('type' => 'string', 'null' => true, 'length' => 200),
		'saldo' => array('type' => 'string', 'null' => true, 'length' => 300),
		'empresa_id' => array('type' => 'integer', 'null' => true),
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
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'numerocuenta' => 'Lorem ipsum dolor sit amet',
			'saldo' => 'Lorem ipsum dolor sit amet',
			'empresa_id' => 1,
			'created' => '2017-02-12 23:07:37'
		),
	);

}
