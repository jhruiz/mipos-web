<?php
/**
 * EliminarmultiFixture
 *
 */
class EliminarmultiFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'eliminarmulti';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'eliminarmulti_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'estado' => array('type' => 'boolean', 'null' => true),
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
			'paquete_id' => 1,
			'estado' => 1
		),
	);

}
