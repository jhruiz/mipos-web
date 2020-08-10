<?php
App::uses('Configuraciondato', 'Model');

/**
 * Configuraciondato Test Case
 *
 */
class ConfiguraciondatoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.configuraciondato'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Configuraciondato = ClassRegistry::init('Configuraciondato');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Configuraciondato);

		parent::tearDown();
	}

/**
 * testObtenerIdDatoConfig method
 *
 * @return void
 */
	public function testObtenerIdDatoConfig() {
	}

/**
 * testObtenerValorDatoConfig method
 *
 * @return void
 */
	public function testObtenerValorDatoConfig() {
	}

/**
 * testObtenerInfo method
 *
 * @return void
 */
	public function testObtenerInfo() {
	}

}
