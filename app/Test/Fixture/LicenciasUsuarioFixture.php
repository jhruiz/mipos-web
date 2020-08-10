<?php
/**
 * LicenciasUsuarioFixture
 *
 */
class LicenciasUsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'licencias_usuarios_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'fechainicio' => array('type' => 'datetime', 'null' => true),
		'fechafin' => array('type' => 'datetime', 'null' => true),
		'licencia_id' => array('type' => 'integer', 'null' => false),
		'usuario_id' => array('type' => 'integer', 'null' => true),
		'estado_id' => array('type' => 'integer', 'null' => false),
		'codigo' => array('type' => 'string', 'null' => false, 'length' => 100),
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
			'fechainicio' => '2016-10-15 10:23:58',
			'fechafin' => '2016-10-15 10:23:58',
			'licencia_id' => 1,
			'usuario_id' => 1,
			'estado_id' => 1,
			'codigo' => 'Lorem ipsum dolor sit amet'
		),
	);

}
