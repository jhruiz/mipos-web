<?php
App::uses('DepositosUsuario', 'Model');

/**
 * DepositosUsuario Test Case
 *
 */
class DepositosUsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.depositos_usuario',
		'app.deposito',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.anotacione',
		'app.cliente',
		'app.ciudade',
		'app.depositos_cliente',
		'app.cargueinventario',
		'app.producto',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
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
		$this->DepositosUsuario = ClassRegistry::init('DepositosUsuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DepositosUsuario);

		parent::tearDown();
	}

}
