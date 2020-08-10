<?php
App::uses('Licencia', 'Model');

/**
 * Licencia Test Case
 *
 */
class LicenciaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.licencia',
		'app.usuario',
		'app.perfile',
		'app.estado',
		'app.empresa',
		'app.anotacione',
		'app.cliente',
		'app.ciudade',
		'app.paise',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.cargueinventario',
		'app.producto',
		'app.impuesto',
		'app.tipopago',
		'app.descargueinventario',
		'app.depositos_cliente',
		'app.categoria',
		'app.licencias_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Licencia = ClassRegistry::init('Licencia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Licencia);

		parent::tearDown();
	}

}
