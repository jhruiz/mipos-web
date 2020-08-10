<?php
/**
 * EstadopaqueteFixture
 *
 */
class EstadopaqueteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'estadopaquetes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => false, 'length' => 45),
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
			'descripcion' => 'Lorem ipsum dolor sit amet'
		),
	);

}
