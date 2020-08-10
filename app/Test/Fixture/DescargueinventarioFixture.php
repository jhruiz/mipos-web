<?php
/**
 * DescargueinventarioFixture
 *
 */
class DescargueinventarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'descargueinventarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'cantidaddescargue' => array('type' => 'integer', 'null' => true),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'tipopago_id' => array('type' => 'integer', 'null' => true),
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
			'producto_id' => 1,
			'deposito_id' => 1,
			'cantidaddescargue' => 1,
			'usuario_id' => 1,
			'created' => '2016-11-11 13:57:19',
			'tipopago_id' => 1
		),
	);

}
