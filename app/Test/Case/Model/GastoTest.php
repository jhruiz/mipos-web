<?php
App::uses('Gasto', 'Model');

/**
 * Gasto Test Case
 *
 */
class GastoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gasto',
		'app.usuario',
		'app.perfile',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
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
		'app.impuesto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gasto = ClassRegistry::init('Gasto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gasto);

		parent::tearDown();
	}

}
