<?php
App::uses('Regimene', 'Model');

/**
 * Regimene Test Case
 *
 */
class RegimeneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.regimene',
		'app.deposito'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Regimene = ClassRegistry::init('Regimene');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Regimene);

		parent::tearDown();
	}

}
