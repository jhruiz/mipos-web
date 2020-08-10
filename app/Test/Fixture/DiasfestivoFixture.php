<?php
/**
 * DiasfestivoFixture
 *
 */
class DiasfestivoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'diasfestivos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'fecha' => array('type' => 'datetime', 'null' => true),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 300),
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
			'fecha' => '2016-07-28 09:23:52',
			'descripcion' => 'Lorem ipsum dolor sit amet'
		),
	);

}
