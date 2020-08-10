<?php
/**
 * DepositosClienteFixture
 *
 */
class DepositosClienteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'depositos_clientes_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'cliente_id' => array('type' => 'integer', 'null' => false),
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
			'deposito_id' => 1,
			'cliente_id' => 1
		),
	);

}
