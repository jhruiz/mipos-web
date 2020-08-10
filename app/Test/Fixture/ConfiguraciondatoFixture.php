<?php
/**
 * ConfiguraciondatoFixture
 *
 */
class ConfiguraciondatoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'configuraciondatos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'length' => 50),
		'valor' => array('type' => 'string', 'null' => false, 'length' => 150),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'uq_configuraciondatos_nombre' => array('unique' => true, 'column' => 'nombre')
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
			'valor' => 'Lorem ipsum dolor sit amet'
		),
	);

}
