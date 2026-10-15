<?php
ob_start();

session_set_cookie_params([
	'httponly' => true,
	'samesite' => 'Lax',
]);
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/codigo_funciones.php';

