<?php
/**
 * MotivosrechazosPaqueteFixture
 *
 */
class MotivosrechazosPaqueteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'motivosrechazos_paquetes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'motivosrechazo_id' => array('type' => 'integer', 'null' => false),
		'paquete_id' => array('type' => 'integer', 'null' => false),
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
			'motivosrechazo_id' => 1,
			'paquete_id' => 1
		),
	);

}
