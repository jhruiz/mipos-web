<?php
/**
 * CategoriaFixture
 *
 */
class CategoriaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'categorias_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 300),
		'empresa_id' => array('type' => 'integer', 'null' => false),
		'mostrarencatalogo' => array('type' => 'boolean', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true),
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
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'empresa_id' => 1,
			'mostrarencatalogo' => 1,
			'created' => '2016-10-15 10:24:36',
			'usuario_id' => 1
		),
	);

}
