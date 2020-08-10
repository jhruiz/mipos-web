<?php
App::uses('Utilidade', 'Model');

/**
 * Utilidade Test Case
 *
 */
class UtilidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.utilidade',
		'app.cargueinventario',
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
		'app.depositos_cliente',
		'app.licencias_usuario',
		'app.licencia',
		'app.anotacione',
		'app.impuesto',
		'app.proveedore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Utilidade = ClassRegistry::init('Utilidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Utilidade);

		parent::tearDown();
	}

}
