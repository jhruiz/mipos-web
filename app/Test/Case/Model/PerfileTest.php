<?php
App::uses('Perfile', 'Model');

/**
 * Perfile Test Case
 *
 */
class PerfileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.perfile',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.estado',
		'app.tipopago',
		'app.cargueinventario',
		'app.producto',
		'app.categoria',
		'app.descargueinventario',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.depositos_cliente',
		'app.impuesto',
		'app.licencias_usuario',
		'app.licencia',
		'app.anotacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Perfile = ClassRegistry::init('Perfile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Perfile);

		parent::tearDown();
	}

}
