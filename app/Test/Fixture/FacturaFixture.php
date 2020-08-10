<?php
/**
 * FacturaFixture
 *
 */
class FacturaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'facturas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => false, 'default' => 'nextval((\'facturas_codigo_seq\'', 'length' => 50),
		'cliente_id' => array('type' => 'integer', 'null' => true),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
		'fechavence' => array('type' => 'datetime', 'null' => true),
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
			'codigo' => 'Lorem ipsum dolor sit amet',
			'cliente_id' => 1,
			'empresa_id' => 1,
			'usuario_id' => 1,
			'created' => '2016-12-08 22:42:09',
			'fechavence' => '2016-12-08 22:42:09',
			'tipopago_id' => 1
		),
	);

}
