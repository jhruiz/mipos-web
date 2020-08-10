<?php
/**
 * DocumentoFixture
 *
 */
class DocumentoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'documentos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'tiposdocumento_id' => array('type' => 'integer', 'null' => false),
		'codigo' => array('type' => 'string', 'null' => false, 'default' => 'nextval((\'documentos_codigo_seq\'', 'length' => 50),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
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
			'tiposdocumento_id' => 1,
			'codigo' => 'Lorem ipsum dolor sit amet',
			'empresa_id' => 1,
			'usuario_id' => 1
		),
	);

}
