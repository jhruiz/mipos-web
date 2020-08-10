<?php
/**
 * GastoFixture
 *
 */
class GastoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'gastos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'empresa_id' => array('type' => 'integer', 'null' => true),
		'fechagasto' => array('type' => 'datetime', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'valor' => array('type' => 'string', 'null' => true, 'length' => 300),
		'cuenta_id' => array('type' => 'integer', 'null' => false),
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
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'usuario_id' => 1,
			'empresa_id' => 1,
			'fechagasto' => '2017-02-12 23:11:34',
			'created' => '2017-02-12 23:11:34',
			'valor' => 'Lorem ipsum dolor sit amet',
			'cuenta_id' => 1
		),
	);

}
