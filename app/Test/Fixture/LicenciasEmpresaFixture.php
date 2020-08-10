<?php
/**
 * LicenciasEmpresaFixture
 *
 */
class LicenciasEmpresaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'licencias_empresas_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'fechainicio' => array('type' => 'datetime', 'null' => true),
		'fechafin' => array('type' => 'datetime', 'null' => true),
		'licencia_id' => array('type' => 'integer', 'null' => false),
		'empresa_id' => array('type' => 'integer', 'null' => true),
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
			'fechainicio' => '2016-12-14 23:01:23',
			'fechafin' => '2016-12-14 23:01:23',
			'licencia_id' => 1,
			'empresa_id' => 1,
			'estado_id' => 1,
			'codigo' => 'Lorem ipsum dolor sit amet'
		),
	);

}
