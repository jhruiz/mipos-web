<?php
App::uses('Tipopago', 'Model');

/**
 * Tipopago Test Case
 *
 */
class TipopagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipopago',
		'app.estado',
		'app.empresa',
		'app.cargueinventario',
		'app.descargueinventario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipopago = ClassRegistry::init('Tipopago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipopago);

		parent::tearDown();
	}

}
