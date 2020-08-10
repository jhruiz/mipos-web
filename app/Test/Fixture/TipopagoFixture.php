<?php
/**
 * TipopagoFixture
 *
 */
class TipopagoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'tipopagos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'integer', 'null' => true),
		'contabilizar' => array('type' => 'boolean', 'null' => true),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'empresa_id' => array('type' => 'integer', 'null' => false),
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
			'descripcion' => 1,
			'contabilizar' => 1,
			'estado_id' => 1,
			'empresa_id' => 1
		),
	);

}
