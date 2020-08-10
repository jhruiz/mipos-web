<?php
/**
 * AnotacioneFixture
 *
 */
class AnotacioneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'anotaciones_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'cliente_id' => array('type' => 'integer', 'null' => false),
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
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'usuario_id' => 1,
			'cliente_id' => 1,
			'created' => '2016-10-15 09:55:32'
		),
	);

}
