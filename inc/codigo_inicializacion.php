<?php
ob_start();

session_set_cookie_params([
	'httponly' => true,
	'samesite' => 'Lax',
]);
session_start();
const OK = 0;
const ERROR_ALTA_USUARIO = 1;
const ERROR_USUARIO_DUPLICADO = 2;

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/codigo_funciones.php';

