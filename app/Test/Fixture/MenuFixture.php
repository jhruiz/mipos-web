<?php
/**
 * MenuFixture
 *
 */
class MenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'menus_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'url' => array('type' => 'string', 'null' => true, 'length' => 500),
		'imagen' => array('type' => 'string', 'null' => true, 'length' => 300),
		'menu_id' => array('type' => 'integer', 'null' => true),
		'orden' => array('type' => 'integer', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'menus_orden_key' => array('unique' => true, 'column' => 'orden')
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
			'menu_id' => 1,
			'orden' => 1
		),
	);

}
