<?php

require_once __DIR__ . '/../../inc/codigo_inicializacion.php';
require_once RAIZ_FISICA . 'src/modelos/gasto.php';
require_once RAIZ_FISICA . 'src/modelos/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && array_key_exists('newExpense',$_POST)){
    $payer = mb_strtolower(trim(postString('fPayer')));
    $concept = trim(postString('fConcept'));
    $amount = str_replace(',','.',trim(postString('fAmount')));

    $errors = [];
    $formData = [
        'payer' => $payer,
        'concept' => $concept,
        'amount' => $amount,
    ];

    if (findUserByEmail($pdo, $payer) === null){
        $errors['payer'] = 'Selecciona un pagador válido.';
    }

    if ($concept === '' || mb_strlen($concept)>100){
        $errors['concept'] = 'El concepto es obligatorio y no puede superar los 100 caracteres.';
    }

    if (preg_match('/^\d{1,8}(\.\d{1,2})?$/', $amount) !== 1 || (float) $amount <= 0){
        $errors['amount'] = 'El importe debe ser un número positivo con dos decimales como máximo (por ejemplo, 12.50).';
    }

    if (count($errors) > 0){
        $_SESSION['expense_errors'] = $errors;
        $_SESSION['expense_data'] = $formData;
        header('Location: ' . RAIZ_URL . 'index.php?seccion=expenses',true,303);
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