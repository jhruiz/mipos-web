<?php
/**
 * ValidacionporfechaFixture
 *
 */
class ValidacionporfechaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'validacionporfechas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'generacion_ordenamiento' => array('type' => 'datetime', 'null' => true),
		'corteadmision_anterior' => array('type' => 'datetime', 'null' => true),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			
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
			'generacion_ordenamiento' => '2014-05-29 10:44:36',
			'corteadmision_anterior' => '2014-05-29 10:44:36',
			'paquete_id' => 1
		),
	);

}
