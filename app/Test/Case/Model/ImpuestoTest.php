<?php
App::uses('Impuesto', 'Model');

/**
 * Impuesto Test Case
 *
 */
class ImpuestoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.impuesto',
		'app.empresa',
		'app.cargueinventario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Impuesto = ClassRegistry::init('Impuesto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Impuesto);

		parent::tearDown();
	}

}
