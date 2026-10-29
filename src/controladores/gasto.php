<?php


require_once __DIR__ . '/../../inc/codigo_inicializacion.php';
require_once RAIZ_FISICA . 'src/modelos/gasto.php';
require_once RAIZ_FISICA . 'src/modelos/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('newExpense',$_POST)){
    $payer = mb_strtolower(trim(postString('fPayer')));
    $concept = trim(postString('fConcept'));
    $amount = str_replace(',','.',trim(postString('fAmount')));

    $valid = findUserByEmail($pdo, $payer) !== null
        && $concept !== '' && mb_strlen($concept) <= 100
        && preg_match ('/^\d{1,8}(\.\d{1,2})?$/', $amount) === 1
        && (float) $amount > 0;

    if (!$valid){
        header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses&resultado=gasto_invalido',true,303);
        exit();
    }

    if (createExpense($pdo, $payer, $concept, $amount)) {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses&resultado=gasto_creado',true,303);
    } else {
        header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses&resultado=gasto_error',true,303);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('cancelExpense', $_POST)){
    $id = intval($_POST['fId'] ?? 0);

    if ($id > 0 && deleteExpense($pdo, $id)){
        header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses&resultado=gasto_anulado', true,303);
    } else {
        header ('Location: ' . RAIZ_URL . 'index.php?seccion=expenses&resultado=gasto_anular_error',true,303);
    }
    exit();
}

header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses',true,303);
exit;