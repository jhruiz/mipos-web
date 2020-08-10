<?php
/**
 * BandejacampoFixture
 *
 */
class BandejacampoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'bandejacampos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'bandeja_id' => array('type' => 'integer', 'null' => false),
		'campo_id' => array('type' => 'integer', 'null' => false),
		'campo_requerido' => array('type' => 'boolean', 'null' => true),
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
			'bandeja_id' => 1,
			'campo_id' => 1,
			'campo_requerido' => 1,
			'created' => '2014-05-29 10:54:12'
		),
	);

}
