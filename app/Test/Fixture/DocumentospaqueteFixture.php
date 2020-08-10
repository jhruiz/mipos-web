<?php
/**
 * DocumentospaqueteFixture
 *
 */
class DocumentospaqueteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'documentospaquetes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 250),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'documento_id' => array('type' => 'integer', 'null' => true),
		'glosado' => array('type' => 'boolean', 'null' => true),
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
			'nombre' => 'Lorem ipsum dolor sit amet',
			'paquete_id' => 1,
			'documento_id' => 1,
			'glosado' => 1
		),
	);

}
