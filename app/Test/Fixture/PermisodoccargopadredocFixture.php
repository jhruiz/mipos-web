<?php
/**
 * PermisodoccargopadredocFixture
 *
 */
class PermisodoccargopadredocFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'permisodoccargopadredocs_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'cargo_id' => array('type' => 'integer', 'null' => false),
		'padredocumentale_id' => array('type' => 'integer', 'null' => false),
		'permisodoc_id' => array('type' => 'integer', 'null' => false),
		'otorgado' => array('type' => 'boolean', 'null' => false),
		'created' => array('type' => 'time', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'ixfk_permisodoccargopadredocs_cargos' => array('unique' => false, 'column' => 'cargo_id'),
			'ixfk_permisodoccargopadredocs_padredocumentales' => array('unique' => false, 'column' => 'padredocumentale_id'),
			'ixfk_permisodoccargopadredocs_permisodocs' => array('unique' => false, 'column' => 'permisodoc_id')
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
			'cargo_id' => 1,
			'padredocumentale_id' => 1,
			'permisodoc_id' => 1,
			'otorgado' => 1,
			'created' => '18:13:08'
		),
	);

}
