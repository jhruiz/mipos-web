<?php
App::uses('Tipodeposito', 'Model');

/**
 * Tipodeposito Test Case
 *
 */
class TipodepositoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipodeposito',
		'app.empresa',
		'app.deposito',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.anotacione',
		'app.cargueinventario',
		'app.producto',
		'app.categoria',
		'app.descargueinventario',
		'app.tipopago',
		'app.impuesto',
		'app.depositos_usuario',
		'app.licencia',
		'app.licencias_usuario',
		'app.depositos_cliente',
		'app.regimene'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipodeposito = ClassRegistry::init('Tipodeposito');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipodeposito);

		parent::tearDown();
	}

}
