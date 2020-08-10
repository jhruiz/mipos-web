<?php
/**
 * EstadoFixture
 *
 */
class EstadoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'estados_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'estadoinicial' => array('type' => 'boolean', 'null' => true),
		'estadofinal' => array('type' => 'boolean', 'null' => true),
		'estadoanulado' => array('type' => 'boolean', 'null' => true),
		'adjuntararchivos' => array('type' => 'boolean', 'null' => true),
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
			'estadoinicial' => 1,
			'estadofinal' => 1,
			'estadoanulado' => 1,
			'adjuntararchivos' => 1
		),
	);

}
