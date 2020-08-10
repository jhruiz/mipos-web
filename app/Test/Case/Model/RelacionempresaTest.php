<?php
App::uses('Relacionempresa', 'Model');

/**
 * Relacionempresa Test Case
 *
 */
class RelacionempresaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.relacionempresa',
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
		'app.impuesto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Relacionempresa = ClassRegistry::init('Relacionempresa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Relacionempresa);

		parent::tearDown();
	}

}
