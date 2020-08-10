<?php
App::uses('Factura', 'Model');

/**
 * Factura Test Case
 *
 */
class FacturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.factura',
		'app.cliente',
		'app.ciudade',
		'app.paise',
		'app.deposito',
		'app.empresa',
		'app.impuesto',
		'app.tipopago',
		'app.estado',
		'app.cargueinventario',
		'app.producto',
		'app.categoria',
		'app.usuario',
		'app.perfile',
		'app.anotacione',
		'app.depositos_usuario',
		'app.descargueinventario',
		'app.licencia',
		'app.licencias_usuario',
		'app.proveedore',
		'app.tipodeposito',
		'app.regimene',
		'app.depositos_cliente',
		'app.facturasdetalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Factura = ClassRegistry::init('Factura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Factura);

		parent::tearDown();
	}

}
