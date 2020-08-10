<?php
/**
 * EmpresaFixture
 *
 */
class EmpresaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'empresas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 300),
		'nit' => array('type' => 'string', 'null' => true, 'length' => 150),
		'direccion' => array('type' => 'string', 'null' => true, 'length' => 250),
		'telefono1' => array('type' => 'string', 'null' => true, 'length' => 150),
		'telefono2' => array('type' => 'string', 'null' => true, 'length' => 150),
		'email' => array('type' => 'string', 'null' => true, 'length' => 300),
		'representantelegal' => array('type' => 'string', 'null' => true, 'length' => 300),
		'ciudade_id' => array('type' => 'integer', 'null' => false),
		'imagen' => array('type' => 'string', 'null' => true, 'length' => 300),
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
			'nombre' => 'Lorem ipsum dolor sit amet',
			'nit' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'telefono1' => 'Lorem ipsum dolor sit amet',
			'telefono2' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'representantelegal' => 'Lorem ipsum dolor sit amet',
			'ciudade_id' => 1,
			'imagen' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-10-15 10:27:48'
		),
	);

}
