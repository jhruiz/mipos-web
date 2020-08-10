<?php
/**
 * ProductoFixture
 *
 */
class ProductoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'productos_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => true, 'length' => 100),
		'descripcion' => array('type' => 'string', 'null' => true, 'length' => 300),
		'imagen' => array('type' => 'string', 'null' => true, 'length' => 300),
		'categoria_id' => array('type' => 'integer', 'null' => false),
		'marca' => array('type' => 'string', 'null' => true, 'length' => 200),
		'existenciaminima' => array('type' => 'string', 'null' => true, 'length' => 100),
		'existenciamaxima' => array('type' => 'string', 'null' => true, 'length' => 100),
		'costopromedio' => array('type' => 'string', 'null' => true, 'length' => 200),
		'mostrarencatalogo' => array('type' => 'boolean', 'null' => false),
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
			'codigo' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'imagen' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 1,
			'marca' => 'Lorem ipsum dolor sit amet',
			'existenciaminima' => 'Lorem ipsum dolor sit amet',
			'existenciamaxima' => 'Lorem ipsum dolor sit amet',
			'costopromedio' => 'Lorem ipsum dolor sit amet',
			'mostrarencatalogo' => 1,
			'created' => '2016-10-15 10:25:05'
		),
	);

}
