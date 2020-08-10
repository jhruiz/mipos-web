<?php
App::uses('Precargueinventario', 'Model');

/**
 * Precargueinventario Test Case
 *
 */
class PrecargueinventarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.precargueinventario',
		'app.producto',
		'app.categoria',
		'app.usuario',
		'app.perfile',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.estado',
		'app.tipopago',
		'app.descargueinventario',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.cargueinventario',
		'app.proveedore',
		'app.depositos_cliente',
		'app.licencias_usuario',
		'app.licencia',
		'app.anotacione',
		'app.impuesto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Precargueinventario = ClassRegistry::init('Precargueinventario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Precargueinventario);

		parent::tearDown();
	}

}
