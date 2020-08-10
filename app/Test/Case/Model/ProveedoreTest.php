<?php
App::uses('Proveedore', 'Model');

/**
 * Proveedore Test Case
 *
 */
class ProveedoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proveedore',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.perfile',
		'app.empresa',
		'app.impuesto',
		'app.cargueinventario',
		'app.producto',
		'app.categoria',
		'app.descargueinventario',
		'app.deposito',
		'app.estado',
		'app.tipopago',
		'app.licencias_usuario',
		'app.licencia',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.depositos_cliente',
		'app.anotacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proveedore = ClassRegistry::init('Proveedore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proveedore);

		parent::tearDown();
	}

}
