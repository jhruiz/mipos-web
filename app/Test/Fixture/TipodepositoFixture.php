<?php
/**
 * TipodepositoFixture
 *
 */
class TipodepositoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'tipodepositos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 200),
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
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'empresa_id' => 1
		),
	);

}
