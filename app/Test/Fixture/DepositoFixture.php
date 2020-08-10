<?php
/**
 * DepositoFixture
 *
 */
class DepositoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'depositos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'ciudade_id' => array('type' => 'integer', 'null' => false),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'telefono' => array('type' => 'string', 'null' => true, 'length' => 150),
		'direccion' => array('type' => 'string', 'null' => true, 'length' => 200),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'nombredocumentoventa' => array('type' => 'string', 'null' => true, 'length' => 300),
		'resolucionfacturacion' => array('type' => 'string', 'null' => true, 'length' => 300),
		'tipodeposito_id' => array('type' => 'integer', 'null' => false),
		'fecharesolucion' => array('type' => 'datetime', 'null' => true),
		'prefijo' => array('type' => 'string', 'null' => true, 'length' => 100),
		'regimene_id' => array('type' => 'integer', 'null' => false),
		'nota' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
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
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'empresa_id' => 1,
			'ciudade_id' => 1,
			'estado_id' => 1,
			'telefono' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'usuario_id' => 1,
			'nombredocumentoventa' => 'Lorem ipsum dolor sit amet',
			'resolucionfacturacion' => 'Lorem ipsum dolor sit amet',
			'tipodeposito_id' => 1,
			'fecharesolucion' => '2016-10-15 10:19:18',
			'prefijo' => 'Lorem ipsum dolor sit amet',
			'regimene_id' => 1,
			'nota' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2016-10-15 10:19:18'
		),
	);

}
