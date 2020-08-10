<?php
/**
 * TrazabilidadeFixture
 *
 */
class TrazabilidadeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'trazabilidades_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'estadodestino_id' => array('type' => 'integer', 'null' => false),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'indicador_actual' => array('type' => 'boolean', 'null' => false),
		'paquetesusuario_id' => array('type' => 'integer', 'null' => false),
		'diaspromedio' => array('type' => 'integer', 'null' => true),
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
			'estado_id' => 1,
			'estadodestino_id' => 1,
			'paquete_id' => 1,
			'usuario_id' => 1,
			'indicador_actual' => 1,
			'paquetesusuario_id' => 1,
			'diaspromedio' => 1,
			'created' => '2016-01-26 12:06:26'
		),
	);

}
