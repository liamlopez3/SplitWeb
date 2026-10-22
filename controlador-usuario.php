<?php
require_once __DIR__ . '/inc/codigo_inicializacion.php';
require_once __DIR__ . '/inc/modelo-usuario.php';

// --- Registro ---
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
        header('Location: register.php?resultado=registro_invalido', true, 303);
        exit();
    }

    $result = createUser($pdo, $email, password_hash($password, PASSWORD_DEFAULT), $fullName, $nickname);

    if ($result === OK) {
        header('Location: login.php?resultado=registro_ok', true, 303);
    } elseif ($result === ERROR_USUARIO_DUPLICADO) {
        header('Location: register.php?resultado=registro_duplicado', true, 303);
    } else {
        header('Location: register.php?resultado=error_interno', true, 303);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('loginUser', $_POST)) {
    $email    = mb_strtolower(trim(postString('fEmail')));
    $password = postString('fPassword');

    $user = findUserByEmail($pdo, $email);

    if ($user === null || !password_verify($password, $user['password_hash'])) {
        header('Location: login.php?resultado=login_error', true, 303);
        exit();
    }

    session_regenerate_id(true);
    $_SESSION['user_email']    = $user['email'];
    $_SESSION['user_nickname'] = $user['nickname'];

    header('Location: index.php', true, 303);
    exit();
}

header('Location: register.php', true, 303);
exit();