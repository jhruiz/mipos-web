<?php
/**
 * BandejacampovaloreFixture
 *
 */
class BandejacampovaloreFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'bandejacampovalores_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'valor' => array('type' => 'string', 'null' => true, 'length' => 50),
		'bandejacampo_id' => array('type' => 'integer', 'null' => false),
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
			'valor' => 'Lorem ipsum dolor sit amet',
			'bandejacampo_id' => 1,
			'paquete_id' => 1
		),
	);

}
