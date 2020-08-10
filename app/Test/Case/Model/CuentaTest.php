<?php
App::uses('Cuenta', 'Model');

/**
 * Cuenta Test Case
 *
 */
class CuentaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuenta',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.tipopago',
		'app.descargueinventario',
		'app.producto',
		'app.categoria',
		'app.cargueinventario',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.depositos_cliente',
		'app.proveedore',
		'app.licencias_usuario',
		'app.licencia',
		'app.anotacione',
		'app.impuesto',
		'app.gasto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuenta = ClassRegistry::init('Cuenta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuenta);

		parent::tearDown();
	}

}
