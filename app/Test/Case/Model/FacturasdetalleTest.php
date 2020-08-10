<?php
App::uses('Facturasdetalle', 'Model');

/**
 * Facturasdetalle Test Case
 *
 */
class FacturasdetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.facturasdetalle',
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
		'app.depositos_cliente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Facturasdetalle = ClassRegistry::init('Facturasdetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Facturasdetalle);

		parent::tearDown();
	}

}
