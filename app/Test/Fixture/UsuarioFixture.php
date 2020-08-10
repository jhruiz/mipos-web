<?php
/**
 * UsuarioFixture
 *
 */
class UsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'usuarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 200),
		'identificacion' => array('type' => 'integer', 'null' => true),
		'username' => array('type' => 'string', 'null' => true, 'length' => 1),
		'imagen' => array('type' => 'string', 'null' => true, 'length' => 300),
		'perfile_id' => array('type' => 'integer', 'null' => false),
		'password' => array('type' => 'string', 'null' => false, 'length' => 200),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'estadologin' => array('type' => 'boolean', 'null' => true),
		'empresa_id' => array('type' => 'integer', 'null' => false),
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
			'identificacion' => 1,
			'username' => 'Lorem ipsum dolor sit ame',
			'imagen' => 'Lorem ipsum dolor sit amet',
			'perfile_id' => 1,
			'password' => 'Lorem ipsum dolor sit amet',
			'estado_id' => 1,
			'estadologin' => 1,
			'empresa_id' => 1,
			'created' => '2016-10-15 10:02:00'
		),
	);

}
