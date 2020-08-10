<?php
App::uses('DepositosCliente', 'Model');

/**
 * DepositosCliente Test Case
 *
 */
class DepositosClienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.depositos_cliente',
		'app.deposito',
		'app.cliente',
		'app.ciudade',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.anotacione',
		'app.cargueinventario',
		'app.producto',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
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
		$this->DepositosCliente = ClassRegistry::init('DepositosCliente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DepositosCliente);

		parent::tearDown();
	}

}
