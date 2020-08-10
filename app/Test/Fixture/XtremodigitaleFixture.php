<?php
/**
 * XtremodigitaleFixture
 *
 */
class XtremodigitaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'tipocampos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'paquete_id' => array('type' => 'integer', 'null' => false),
		'url_archivos' => array('type' => 'text', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'multitiff_generado' => array('type' => 'boolean', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'fki_paquete_id' => array('unique' => false, 'column' => 'paquete_id')
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
			'paquete_id' => 1,
			'url_archivos' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2014-05-29 10:45:20',
			'multitiff_generado' => 1
		),
	);

}
