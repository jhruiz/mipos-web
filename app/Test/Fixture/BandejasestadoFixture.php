<?php
/**
 * BandejasEstadoFixture
 *
 */
class BandejasEstadoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'bandejas_estados_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'analisiscargas' => array('type' => 'boolean', 'null' => true),
		'bandeja_id' => array('type' => 'integer', 'null' => false),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'etiquetacambioestado_id' => array('type' => 'integer', 'null' => false),
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
			'analisiscargas' => 1,
			'bandeja_id' => 1,
			'estado_id' => 1,
			'etiquetacambioestado_id' => 1
		),
	);

}
