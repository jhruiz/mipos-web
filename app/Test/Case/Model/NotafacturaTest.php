<?php
App::uses('Notafactura', 'Model');

/**
 * Notafactura Test Case
 *
 */
class NotafacturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notafactura',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.perfile',
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
		'app.impuesto',
		'app.factura',
		'app.facturasdetalle',
		'app.facturas_notafactura'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notafactura = ClassRegistry::init('Notafactura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notafactura);

		parent::tearDown();
	}

}
