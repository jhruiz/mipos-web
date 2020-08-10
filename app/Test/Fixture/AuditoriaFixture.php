<?php
/**
 * AuditoriaFixture
 *
 */
class AuditoriaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'auditorias_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'descripcion' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'accion' => array('type' => 'string', 'null' => true, 'length' => 50),
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
			'usuario_id' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'accion' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-05-29 10:51:06'
		),
	);

}
