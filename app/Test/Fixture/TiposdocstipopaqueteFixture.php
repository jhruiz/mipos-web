<?php
/**
 * TiposdocstipopaqueteFixture
 *
 */
class TiposdocstipopaqueteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'tiposdocstipopaquetes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'tipopaquete_id' => array('type' => 'integer', 'null' => false),
		'tiposdocumentale_id' => array('type' => 'integer', 'null' => false),
		'obligatorio' => array('type' => 'boolean', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'ixfk_tiposdocstipopaquetes_tipopaquetes' => array('unique' => false, 'column' => 'tipopaquete_id'),
			'ixfk_tiposdocstipopaquetes_tiposdocumentales' => array('unique' => false, 'column' => 'tiposdocumentale_id')
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
			'tipopaquete_id' => 1,
			'tiposdocumentale_id' => 1,
			'obligatorio' => 1
		),
	);

}
