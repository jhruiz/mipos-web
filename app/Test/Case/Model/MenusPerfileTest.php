<?php
App::uses('MenusPerfile', 'Model');

/**
 * MenusPerfile Test Case
 *
 */
class MenusPerfileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menus_perfile',
		'app.menu',
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
		'app.anotacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenusPerfile = ClassRegistry::init('MenusPerfile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenusPerfile);

		parent::tearDown();
	}

}
