<?php
/**
 * DepositosUsuarioFixture
 *
 */
class DepositosUsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'depositos_usuarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'deposito_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
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
			'usuario_id' => 1,
			'created' => '2016-10-15 10:18:10'
		),
	);

}
