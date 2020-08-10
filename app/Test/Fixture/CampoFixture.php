<?php
/**
 * CampoFixture
 *
 */
class CampoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'campos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 50),
		'tipocampo_id' => array('type' => 'integer', 'null' => false),
		'tipodato_id' => array('type' => 'integer', 'null' => false),
		'obligatorio' => array('type' => 'boolean', 'null' => true),
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
			'tipocampo_id' => 1,
			'tipodato_id' => 1,
			'obligatorio' => 1
		),
	);

}
