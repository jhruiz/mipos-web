<?php
/**
 * PaquetesUsuarioFixture
 *
 */
class PaquetesUsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'paquetes_usuarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'asignado' => array('type' => 'boolean', 'null' => false),
		'fecha_asignacion' => array('type' => 'datetime', 'null' => true),
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
			'paquete_id' => 1,
			'usuario_id' => 1,
			'asignado' => 1,
			'fecha_asignacion' => '2015-12-28 10:59:54'
		),
	);

}
