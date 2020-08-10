<?php
App::uses('LicenciasUsuario', 'Model');

/**
 * LicenciasUsuario Test Case
 *
 */
class LicenciasUsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.licencias_usuario',
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
		'app.categoria'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LicenciasUsuario = ClassRegistry::init('LicenciasUsuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LicenciasUsuario);

		parent::tearDown();
	}

}
