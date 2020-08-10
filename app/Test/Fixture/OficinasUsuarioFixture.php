<?php
/**
 * OficinasUsuarioFixture
 *
 */
class OficinasUsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'oficinas_usuarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'oficina_id' => array('type' => 'integer', 'null' => false),
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
			'oficina_id' => 1,
			'usuario_id' => 1
		),
	);

}
