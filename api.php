<?php
require_once __DIR__ . '/inc/codigo_inicializacion.php';

header('Content-Type: application/json; charset=UTF-8');

$method     = $_SERVER['REQUEST_METHOD'];
$resource   = $_GET['recurso'] ?? '';
$action     = $_GET['accion'] ?? '';
$id         = isset($_GET['id']) ? intval($_GET['id']) : null;

function respondJson(int $httpCode, array $data): void {
    http_response_code($httpCode);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

switch ($resource) {
    case 'auth':
        require_once RAIZ_FISICA . 'src/controladores/usuario_rest.php';
        break;
    case 'gastos':
        if(!isset($_SESSION['user_email'])) {
            respondJson(401, ['estado' => 'error', 'mensaje' => 'No autorizado. Debes iniciar sesión para acceder a este recurso.']);
        }
        require_once RAIZ_FISICA . 'src/controladores/gasto_rest.php';
        break;
    default:
        respondJson(404, ['estado' => 'error', 'mensaje' => 'Recurso no encontrado.']);
}