<?php
/**
 * TipomovimientoFixture
 *
 */
class TipomovimientoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'tipodocumentales_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'seriedoc_id' => array('type' => 'integer', 'null' => false),
		'codigo' => array('type' => 'string', 'null' => false, 'length' => 20),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 100),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uq_tipodocumentales_codigo' => array('unique' => true, 'column' => 'codigo')
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
			'seriedoc_id' => 1,
			'codigo' => 'Lorem ipsum dolor ',
			'nombre' => 'Lorem ipsum dolor sit amet'
		),
	);

}
