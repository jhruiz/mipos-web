<?php
App::uses('Cliente', 'Model');

/**
 * Cliente Test Case
 *
 */
class ClienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cliente',
		'app.ciudade',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.anotacione',
		'app.cargueinventario',
		'app.producto',
		'app.deposito',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
		'app.depositos_usuario',
		'app.categoria',
		'app.licencia',
		'app.licencias_usuario',
		'app.depositos_cliente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cliente = ClassRegistry::init('Cliente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cliente);

		parent::tearDown();
	}

}
