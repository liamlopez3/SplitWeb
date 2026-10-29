<?php
ob_start();

// Raíz física (disco del servidor), para require/include.
// __DIR__ es la carpeta inc/; dirname() sube un nivel hasta la raíz del proyecto.
define('RAIZ_FISICA', dirname(__DIR__) . '/');

// Raíz URL (navegador), para href, src, action y header('Location: ...').
// Se deduce del script que está pidiendo el navegador.
$scriptActual = $_SERVER['SCRIPT_NAME'];
$posicion = strpos($scriptActual, '/src/controladores/');

if ($posicion !== false){
	$baseUrl = substr($scriptActual,0,$posicion);

} else {
	$baseUrl = dirname($scriptActual);
}

define ('RAIZ_URL', rtrim($baseUrl, '/') . '/');

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