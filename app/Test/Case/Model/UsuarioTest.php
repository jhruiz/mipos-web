<?php
App::uses('Usuario', 'Model');

/**
 * Usuario Test Case
 *
 */
class UsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.anotacione',
		'app.cliente',
		'app.cargueinventario',
		'app.producto',
		'app.deposito',
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
		$this->Usuario = ClassRegistry::init('Usuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usuario);

		parent::tearDown();
	}

}
