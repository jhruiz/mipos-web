<?php
App::uses('Auditoria', 'Model');

/**
 * Auditoria Test Case
 *
 */
class AuditoriaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.auditoria',
		'app.usuario',
		'app.perfile',
		'app.cargo',
		'app.estadoregistro',
		'app.regionale',
		'app.ciudade',		
		'app.trazabilidade',
		'app.estadoproceso',
		'app.paquete',
		'app.bandeja',
		'app.bandejas_estadoproceso',
		'app.permisousuariobandeja',
		'app.paquetes_usuario',
		'app.oficina',
		'app.oficinas_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Auditoria = ClassRegistry::init('Auditoria');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Auditoria);

		parent::tearDown();
	}

}
