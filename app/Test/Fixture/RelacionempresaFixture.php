<?php
/**
 * RelacionempresaFixture
 *
 */
class RelacionempresaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'relacionempresas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 300),
		'nit' => array('type' => 'string', 'null' => true, 'length' => 150),
		'direccion' => array('type' => 'string', 'null' => true, 'length' => 250),
		'telefono1' => array('type' => 'string', 'null' => true, 'length' => 150),
		'email' => array('type' => 'string', 'null' => true, 'length' => 300),
		'representantelegal' => array('type' => 'string', 'null' => true, 'length' => 300),
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
			'empresa_id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'nit' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'telefono1' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'representantelegal' => 'Lorem ipsum dolor sit amet',
			'imagen' => 'Lorem ipsum dolor sit amet',
			'created' => '2017-01-22 22:37:02'
		),
	);

}
