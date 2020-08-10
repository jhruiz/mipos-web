<?php
/**
 * CiudadeFixture
 *
 */
class CiudadeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'ciudades_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 50),
		'regionale_id' => array('type' => 'integer', 'null' => false),
		'estadoregistro_id' => array('type' => 'integer', 'null' => false),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 50),
		'codigo' => array('type' => 'string', 'null' => true, 'length' => 50),
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
			'regionale_id' => 1,
			'estadoregistro_id' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'codigo' => 'Lorem ipsum dolor sit amet'
		),
	);

}
