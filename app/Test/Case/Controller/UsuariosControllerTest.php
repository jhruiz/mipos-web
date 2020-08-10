<?php
App::uses('UsuariosController', 'Controller');

/**
 * UsuariosController Test Case
 *
 */
class UsuariosControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario',
		'app.perfile',
		'app.cargo',
		'app.estadoregistro',		
		'app.trazabilidade',
		'app.auditoria',
		'app.permisousuariobandeja',
		'app.paquete',
		'app.paquetes_usuario',
		'app.oficina',
		'app.oficinas_usuario'
	);

}
