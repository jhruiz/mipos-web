<?php
App::uses('Anotacione', 'Model');

/**
 * Anotacione Test Case
 *
 */
class AnotacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.anotacione',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.cargueinventario',
		'app.producto',
		'app.deposito',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
		'app.cliente',
		'app.depositos_usuario',
		'app.categoria',
		'app.licencia',
		'app.licencias_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Anotacione = ClassRegistry::init('Anotacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Anotacione);

		parent::tearDown();
	}

}
