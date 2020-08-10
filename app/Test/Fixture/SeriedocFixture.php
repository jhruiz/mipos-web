<?php
/**
 * SeriedocFixture
 *
 */
class SeriedocFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'seriedocs_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => false, 'length' => 20),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 50),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uq_series_codigo' => array('unique' => true, 'column' => 'codigo')
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
			'codigo' => 'Lorem ipsum dolor ',
			'nombre' => 'Lorem ipsum dolor sit amet'
		),
	);

}
