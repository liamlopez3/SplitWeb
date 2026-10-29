<?php


require_once __DIR__ . '/../../inc/codigo_inicializacion.php';
require_once RAIZ_FISICA . 'src/modelos/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('registerUser', $_POST)) {
    $email     = mb_strtolower(trim(postString('fEmail')));
    $fullName  = trim(postString('fFullName'));
    $nickname  = trim(postString('fNickname'));
    $password  = postString('fPassword');
    $password2 = postString('fPassword2');

    $valid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false
        && mb_strlen($email) <= 255
        && $fullName !== '' && mb_strlen($fullName) <= 255
        && $nickname !== '' && mb_strlen($nickname) <= 255
        && strlen($password) >= 8 && strlen($password) <= 72
        && $password === $password2;

    if (!$valid) {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=register&resultado=registro_invalido', true, 303);
        exit();
    }

    $result = createUser($pdo, $email, password_hash($password, PASSWORD_DEFAULT), $fullName, $nickname);

    if ($result === OK) {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=login&resultado=registro_ok', true, 303);
    } elseif ($result === ERROR_USUARIO_DUPLICADO) {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=register&resultado=registro_duplicado', true, 303);
    } else {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=register&resultado=error_interno', true, 303);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('loginUser', $_POST)) {
    $email    = mb_strtolower(trim(postString('fEmail')));
    $password = postString('fPassword');

    $user = findUserByEmail($pdo, $email);

    if ($user === null || !password_verify($password, $user['password_hash'])) {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=login&resultado=login_error', true, 303);
        exit();
    }

    session_regenerate_id(true);
    $_SESSION['user_email']    = $user['email'];
    $_SESSION['user_nickname'] = $user['nickname'];

    header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses', true, 303);
    exit();
}

header('Location: ' . RAIZ_URL . 'index.php?seccion=register', true, 303);
exit();