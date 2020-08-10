<?php
/**
 * BandejasEstadoprocesoFixture
 *
 */
class BandejasEstadoprocesoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'bandejas_estadoprocesos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'bandeja_id' => array('type' => 'integer', 'null' => false),
		'estadoproceso_id' => array('type' => 'integer', 'null' => false),
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
			'bandeja_id' => 1,
			'estadoproceso_id' => 1
		),
	);

}
