<?php
/**
 * TrasladoinventarioFixture
 *
 */
class TrasladoinventarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'trasladoinventarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false),
		'depositoorigen_id' => array('type' => 'integer', 'null' => false),
		'depositodestino_id' => array('type' => 'integer', 'null' => false),
		'cantidadtraslado' => array('type' => 'integer', 'null' => true),
		'usuario_id' => array('type' => 'integer', 'null' => false),
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
			'producto_id' => 1,
			'depositoorigen_id' => 1,
			'depositodestino_id' => 1,
			'cantidadtraslado' => 1,
			'usuario_id' => 1,
			'empresa_id' => 1,
			'created' => '2017-01-26 20:58:30'
		),
	);

}
