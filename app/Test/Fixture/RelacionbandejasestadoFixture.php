<?php
/**
 * RelacionbandejasestadoFixture
 *
 */
class RelacionbandejasestadoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'relacionbandejasestados_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'bandeja_id' => array('type' => 'integer', 'null' => false),
		'estado_id' => array('type' => 'integer', 'null' => false),
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
			'estado_id' => 1
		),
	);

}
