<?php
/**
 * EstadoprocesoFixture
 *
 */
class EstadoprocesoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'estadoprocesos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 50),
		'alias' => array('type' => 'string', 'null' => true, 'length' => 20),
		'porcentaje' => array('type' => 'integer', 'null' => false),
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
			'alias' => 'Lorem ipsum dolor ',
			'porcentaje' => 1
		),
	);

}
