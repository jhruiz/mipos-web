<?php
App::uses('Ventarapida', 'Model');

/**
 * Ventarapida Test Case
 *
 */
class VentarapidaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ventarapida',
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
		$this->Ventarapida = ClassRegistry::init('Ventarapida');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ventarapida);

		parent::tearDown();
	}

}
