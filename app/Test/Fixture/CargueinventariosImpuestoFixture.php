<?php
/**
 * CargueinventariosImpuestoFixture
 *
 */
class CargueinventariosImpuestoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'cargueinventarios_impuestos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'cargueinventario_id' => array('type' => 'integer', 'null' => false),
		'impuesto_id' => array('type' => 'integer', 'null' => false),
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
			'cargueinventario_id' => 1,
			'impuesto_id' => 1
		),
	);

}
