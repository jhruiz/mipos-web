<?php
/**
 * PermisodocusuariopadredocFixture
 *
 */
class PermisodocusuariopadredocFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'permisodocusuariopadredocs_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'permisodoc_id' => array('type' => 'integer', 'null' => false),
		'padredocumentale_id' => array('type' => 'integer', 'null' => false),
		'otorgado' => array('type' => 'boolean', 'null' => false),
		'tipo_permiso' => array('type' => 'boolean', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'ixfk_permisodocusuariopadredocs_padredocumentales' => array('unique' => false, 'column' => 'padredocumentale_id'),
			'ixfk_permisodocusuariopadredocs_permisodocs' => array('unique' => false, 'column' => 'permisodoc_id'),
			'ixfk_permisodocusuariopadredocs_usuarios' => array('unique' => false, 'column' => 'usuario_id')
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
			'permisodoc_id' => 1,
			'padredocumentale_id' => 1,
			'otorgado' => 1,
			'tipo_permiso' => 1,
			'created' => '2015-03-16 18:13:33'
		),
	);

}
