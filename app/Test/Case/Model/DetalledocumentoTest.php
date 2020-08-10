<?php
App::uses('Detalledocumento', 'Model');

/**
 * Detalledocumento Test Case
 *
 */
class DetalledocumentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.detalledocumento',
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
		'app.cargueinventario',
		'app.proveedore',
		'app.depositos_cliente',
		'app.licencias_usuario',
		'app.licencia',
		'app.anotacione',
		'app.impuesto',
		'app.depositoorigen',
		'app.depositodestino',
		'app.documento',
		'app.tiposdocumento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Detalledocumento = ClassRegistry::init('Detalledocumento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Detalledocumento);

		parent::tearDown();
	}

}
