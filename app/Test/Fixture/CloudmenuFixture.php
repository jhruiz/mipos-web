<?php
/**
 * CloudmenuFixture
 *
 */
class CloudmenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'cloudmenus_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'url' => array('type' => 'string', 'null' => true, 'length' => 200),
		'imagen' => array('type' => 'string', 'null' => true, 'length' => 300),
		'orden' => array('type' => 'integer', 'null' => true),
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
			'url' => 'Lorem ipsum dolor sit amet',
			'imagen' => 'Lorem ipsum dolor sit amet',
			'orden' => 1
		),
	);

}
