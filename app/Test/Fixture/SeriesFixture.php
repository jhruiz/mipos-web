<?php
/**
 * SeriesFixture
 *
 */
class SeriesFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'series_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 150),
		'codigo' => array('type' => 'string', 'null' => false, 'length' => 50),
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
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'codigo' => 'Lorem ipsum dolor sit amet'
		),
	);

}
