<?php
/**
 * MotivostrasladosPaqueteFixture
 *
 */
class MotivostrasladosPaqueteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'motivostraslados_paquetes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'motivostraslado_id' => array('type' => 'integer', 'null' => false),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'usuarionuevo_id' => array('type' => 'integer', 'null' => false),
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
			'motivostraslado_id' => 1,
			'paquete_id' => 1,
			'usuario_id' => 1,
			'usuarionuevo_id' => 1,
			'created' => '2016-10-06 16:37:52'
		),
	);

}
