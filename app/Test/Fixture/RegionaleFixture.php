<?php
/**
 * RegionaleFixture
 *
 */
class RegionaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'regionales_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => false, 'length' => 20),
		'nombre' => array('type' => 'string', 'null' => true, 'length' => 50),
		'descripcion' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'estadoregistro_id' => array('type' => 'integer', 'null' => false),
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
			'codigo' => 'Lorem ipsum dolor ',
			'nombre' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'estadoregistro_id' => 1
		),
	);

}
