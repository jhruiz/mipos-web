<?php
App::uses('Ciudade', 'Model');

/**
 * Ciudade Test Case
 *
 */
class CiudadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.anotacione',
		'app.cargueinventario',
		'app.producto',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.descargueinventario',
		'app.tipopago',
		'app.depositos_cliente',
		'app.impuesto',
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
		$this->Ciudade = ClassRegistry::init('Ciudade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ciudade);

		parent::tearDown();
	}

}
