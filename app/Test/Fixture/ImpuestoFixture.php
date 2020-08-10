<?php
/**
 * ImpuestoFixture
 *
 */
class ImpuestoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'impuestos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'integer', 'null' => true),
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
			'descripcion' => 1,
			'empresa_id' => 1
		),
	);

}
