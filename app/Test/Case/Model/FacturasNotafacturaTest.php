<?php
App::uses('FacturasNotafactura', 'Model');

/**
 * FacturasNotafactura Test Case
 *
 */
class FacturasNotafacturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.facturas_notafactura',
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
		'app.facturasdetalle',
		'app.notafactura'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FacturasNotafactura = ClassRegistry::init('FacturasNotafactura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FacturasNotafactura);

		parent::tearDown();
	}

}
