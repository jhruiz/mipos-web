<?php
App::uses('Producto', 'Model');

/**
 * Producto Test Case
 *
 */
class ProductoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.producto',
		'app.categoria',
		'app.empresa',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.anotacione',
		'app.cliente',
		'app.ciudade',
		'app.paise',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.cargueinventario',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
		'app.depositos_cliente',
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
		$this->Producto = ClassRegistry::init('Producto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Producto);

		parent::tearDown();
	}

}
