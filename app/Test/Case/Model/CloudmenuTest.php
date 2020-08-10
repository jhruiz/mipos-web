<?php
App::uses('Cloudmenu', 'Model');

/**
 * Cloudmenu Test Case
 *
 */
class CloudmenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cloudmenu',
		'app.perfile',
		'app.empresa',
		'app.ciudade',
		'app.paise',
		'app.cliente',
		'app.usuario',
		'app.estado',
		'app.tipopago',
		'app.cargueinventario',
		'app.producto',
		'app.categoria',
		'app.descargueinventario',
		'app.deposito',
		'app.depositos_usuario',
		'app.tipodeposito',
		'app.regimene',
		'app.depositos_cliente',
		'app.impuesto',
		'app.licencias_usuario',
		'app.licencia',
		'app.anotacione',
		'app.cloudmenus_perfile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cloudmenu = ClassRegistry::init('Cloudmenu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cloudmenu);

		parent::tearDown();
	}

}
