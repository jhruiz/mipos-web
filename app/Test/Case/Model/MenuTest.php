<?php
App::uses('Menu', 'Model');

/**
 * Menu Test Case
 *
 */
class MenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.anotacione',
		'app.menus_perfile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Menu = ClassRegistry::init('Menu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Menu);

		parent::tearDown();
	}

}
