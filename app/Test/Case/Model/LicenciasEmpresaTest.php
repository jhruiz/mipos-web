<?php
App::uses('LicenciasEmpresa', 'Model');

/**
 * LicenciasEmpresa Test Case
 *
 */
class LicenciasEmpresaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.licencias_empresa',
		'app.licencia',
		'app.usuario',
		'app.perfile',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
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
		$this->LicenciasEmpresa = ClassRegistry::init('LicenciasEmpresa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LicenciasEmpresa);

		parent::tearDown();
	}

}
