<?php
/**
 * PrefacturaFixture
 *
 */
class PrefacturaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'prefacturas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'cliente_id' => array('type' => 'integer', 'null' => false),
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
			'usuario_id' => 1,
			'cliente_id' => 1
		),
	);

}
