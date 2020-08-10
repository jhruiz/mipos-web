<?php
/**
 * ProveedoreFixture
 *
 */
class ProveedoreFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'proveedores_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'nit' => array('type' => 'string', 'null' => true, 'length' => 200),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 300),
		'direccion' => array('type' => 'string', 'null' => true, 'length' => 300),
		'telefono' => array('type' => 'string', 'null' => true, 'length' => 150),
		'ciudade_id' => array('type' => 'integer', 'null' => false),
		'paginaweb' => array('type' => 'string', 'null' => true, 'length' => 350),
		'email' => array('type' => 'string', 'null' => true, 'length' => 300),
		'celular' => array('type' => 'string', 'null' => true, 'length' => 150),
		'diascredito' => array('type' => 'integer', 'null' => true),
		'limitecredito' => array('type' => 'string', 'null' => true, 'length' => 200),
		'observaciones' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
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
			'nit' => 'Lorem ipsum dolor sit amet',
			'nombre' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'ciudade_id' => 1,
			'paginaweb' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'celular' => 'Lorem ipsum dolor sit amet',
			'diascredito' => 1,
			'limitecredito' => 'Lorem ipsum dolor sit amet',
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'usuario_id' => 1,
			'estado_id' => 1,
			'created' => '2016-11-07 22:49:12'
		),
	);

}
