<?php
/**
 * UtilidadeFixture
 *
 */
class UtilidadeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'utilidades_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'cargueinventario_id' => array('type' => 'integer', 'null' => false),
		'cantidad' => array('type' => 'integer', 'null' => false),
		'precioventa' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'utilidadbruta' => array('type' => 'string', 'null' => true, 'length' => 200),
		'utilidadporcentual' => array('type' => 'string', 'null' => true, 'length' => 200),
		'empresa_id' => array('type' => 'integer', 'null' => false),
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
			'cargueinventario_id' => 1,
			'cantidad' => 1,
			'precioventa' => 1,
			'created' => '2017-01-03 15:35:24',
			'utilidadbruta' => 'Lorem ipsum dolor sit amet',
			'utilidadporcentual' => 'Lorem ipsum dolor sit amet',
			'empresa_id' => 1
		),
	);

}
