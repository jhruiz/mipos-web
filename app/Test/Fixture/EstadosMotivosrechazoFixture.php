<?php
/**
 * EstadosMotivosrechazoFixture
 *
 */
class EstadosMotivosrechazoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'estados_motivosrechazos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'motivosrechazo_id' => array('type' => 'integer', 'null' => false),
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
			'motivosrechazo_id' => 1
		),
	);

}
