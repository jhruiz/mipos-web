<?php
/**
 * PaqueteFixture
 *
 */
class PaqueteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'paquetes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'num_poliza' => array('type' => 'string', 'null' => true, 'length' => 50),
		'num_referencia' => array('type' => 'string', 'null' => false, 'length' => 50),
		'placa' => array('type' => 'string', 'null' => true, 'length' => 50),
		'estadoproceso_id' => array('type' => 'integer', 'null' => true),
		'oficina_id' => array('type' => 'integer', 'null' => true),
		'fecha_paquete' => array('type' => 'datetime', 'null' => true),
		'estadopaquetes_id' => array('type' => 'integer', 'null' => true),
		'nombre_responsable' => array('type' => 'string', 'null' => true, 'length' => 150),
		'cedula_responsable' => array('type' => 'string', 'null' => true, 'length' => 50),
		'nombre_producto' => array('type' => 'string', 'null' => true, 'length' => 150),
		'nombre_aseguradora' => array('type' => 'string', 'null' => true, 'length' => 150),
		'tipomovimiento_id' => array('type' => 'integer', 'null' => true),
		'ajuste' => array('type' => 'integer', 'null' => true),
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
			'num_poliza' => 'Lorem ipsum dolor sit amet',
			'num_referencia' => 'Lorem ipsum dolor sit amet',
			'placa' => 'Lorem ipsum dolor sit amet',
			'estadoproceso_id' => 1,
			'oficina_id' => 1,
			'fecha_paquete' => '2014-07-11 10:20:56',
			'estadopaquetes_id' => 1,
			'nombre_responsable' => 'Lorem ipsum dolor sit amet',
			'cedula_responsable' => 'Lorem ipsum dolor sit amet',
			'nombre_producto' => 'Lorem ipsum dolor sit amet',
			'nombre_aseguradora' => 'Lorem ipsum dolor sit amet',
			'tipomovimiento_id' => 1,
			'ajuste' => 1
		),
	);

}
