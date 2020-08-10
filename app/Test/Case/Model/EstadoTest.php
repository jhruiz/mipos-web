<?php
App::uses('Estado', 'Model');

/**
 * Estado Test Case
 *
 */
class EstadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.estado',
		'app.bandeja',
		'app.bandejasestado',
		'app.etiquetacambioestado',
		'app.permisousuariobandeja',
		'app.usuario',
		'app.perfile',
		'app.menu',
		'app.menus_perfile',
		'app.estadoregistro',
		'app.regionale',
		'app.ciudade',
		'app.oficina',
		'app.impresorasoficina',
		'app.paquete',
		'app.tipopaquete',
		'app.cabecerapaquete',
		'app.bandejacampovalore',
		'app.distribucionmonto',
		'app.documentos_paquete',
		'app.documento',
		'app.tipodocumento',
		'app.serie',
		'app.infopaquete',
		'app.observacione',
		'app.paquetes_usuario',
		'app.trazabilidade',
		'app.bandejasflujo',
		'app.regionales_usuario',
		'app.auditoria',
		'app.permisobandeja',
		'app.semaforo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Estado = ClassRegistry::init('Estado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estado);

		parent::tearDown();
	}

}
