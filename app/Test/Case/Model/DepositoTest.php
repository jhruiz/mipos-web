<?php
App::uses('Deposito', 'Model');

/**
 * Deposito Test Case
 *
 */
class DepositoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.deposito',
		'app.empresa',
		'app.ciudade',
		'app.estado',
		'app.usuario',
		'app.perfile',
		'app.anotacione',
		'app.cliente',
		'app.depositos_cliente',
		'app.cargueinventario',
		'app.producto',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
		'app.depositos_usuario',
		'app.categoria',
		'app.licencia',
		'app.licencias_usuario',
		'app.tipodeposito',
		'app.regimene'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Deposito = ClassRegistry::init('Deposito');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Deposito);

		parent::tearDown();
	}

}
