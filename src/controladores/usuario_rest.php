<?php
require_once RAIZ_FISICA . 'src/modelos/usuario.php';

switch ($action) {
    case 'login':
        if ($method !== 'POST') {
            respondJson(405, ['estado' => 'error', 'mensaje' => 'Método HTTP no permitido para esta acción.']);
        }
        if (isset($_SESSION['user_email'])) {
            respondJson(400, ['estado' => 'error', 'mensaje' => 'Ya hay una sesión iniciada.']);
        }

        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input)) {
            respondJson(400, ['estado' => 'error', 'mensaje' => 'Cuerpo de la petición JSON inválido.']);
        }

        $email = is_string($input['email'] ?? null) ? mb_strtolower(trim($input['email'])) : '';
        $password = is_string($input['password'] ?? null) ? $input['password'] : '';
        if ($email === '' || $password === '') {
            respondJson(400, ['estado' => 'error', 'mensaje' => 'Faltan el email o la contraseña.']);
        }

        $user = findUserByEmail($pdo, $email);
        if ($user === null || !password_verify($password, $user['password_hash'])) {
            respondJson(401, ['estado' => 'error', 'mensaje' => 'Email o contraseña incorrectos.']);
        }

        session_regenerate_id(true);
        $_SESSION['user_email']     = $user['email'];
        $_SESSION['user_nickname']  = $user['nickname'];

        respondJson(200, [
            'estado' => 'ok',
            'mensaje' => 'Sesión iniciada correctamente.',
            'usuario' => ['email' => $user['email'], 'nickname' => $user['nickname']],
        ]);

    case 'logout':
        if ($method !== 'POST') {
            respondJson(405, ['estado' => 'error', 'mensaje' => 'Método HTTP no permitido para esta acción.']);
        }
        if (!isset($_SESSION['user_email'])) {
            respondJson(401, ['estado' => 'error', 'mensaje' => 'No hay ninguna sesión iniciada.']);
        }

       
        $_SESSION = [];
        $params = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires'  => time() - 3600,
            'path'     => $params['path'],
            'domain'   => $params['domain'],
            'secure'   => $params['secure'],
            'httponly' => $params['httponly'],
            'samesite' => $params['samesite'],
        ]);
        session_destroy();

        respondJson(200, ['estado' => 'ok', 'mensaje' => 'Sesión cerrada correctamente.']);

    case 'miperfil':
        if ($method !== 'GET') {
            respondJson(405, ['estado' => 'error', 'mensaje' => 'Método HTTP no permitido para esta acción.']);
        }
        if (!isset($_SESSION['user_email'])) {
            respondJson(401, ['estado' => 'error', 'mensaje' => 'No hay ninguna sesión iniciada.']);
        }

        respondJson(200, [
            'estado'  => 'ok',
            'mensaje' => 'Sesión activa.',
            'usuario' => ['email' => $_SESSION['user_email'], 'nickname' => $_SESSION['user_nickname']],
        ]);

    default:
        respondJson(404, ['estado' => 'error', 'mensaje' => 'Acción no encontrada.']);
}