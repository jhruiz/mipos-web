<?php
/**
 * CloudmenusPerfileFixture
 *
 */
class CloudmenusPerfileFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => 'nextval((\'cloudmenus_perfiles_id_seq\'', 'length' => 11, 'key' => 'primary'),
		'cloudmenu_id' => array('type' => 'integer', 'null' => false),
		'perfile_id' => array('type' => 'integer', 'null' => false),
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
			'cloudmenu_id' => 1,
			'perfile_id' => 1
		),
	);

}
