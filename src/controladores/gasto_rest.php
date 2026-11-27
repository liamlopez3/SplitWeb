<?php
require_once RAIZ_FISICA . 'src/modelos/gasto.php';

$userEmail = $_SESSION['user_email'];

switch($method) {
    case 'GET':
        $expenses = getActiveExpenses($pdo);
        respondJson(200, [
            'estado'  => 'ok',
            'mensaje' => 'Listado recuperado con éxito.',
            'gastos'  => $expenses,
        ]);

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input)) {
            respondJson(400, ['estado' => 'error', 'mensaje' => 'Cuerpo de la petición JSON inválido.']);
        }

        $concept = is_string($input['concept'] ?? null) ? trim($input['concept']) : '';
        $amount  = is_string($input['amount'] ?? null) ? str_replace(',', '.', trim($input['amount'])) : '';

        $errors = [];
        if ($concept === '' || mb_strlen($concept) > 100) {
            $errors['concept'] = 'El concepto es obligatorio y no puede superar los 100 caracteres.';
        }
        if (preg_match('/^\d{1,8}(\.\d{1,2})?$/', $amount) !== 1 || (float) $amount <= 0) {
            $errors['amount'] = 'El importe debe ser un número positivo con dos decimales como máximo (por ejemplo, "12.50").';
        }
        if (count($errors) > 0) {
            respondJson(400, [
                'estado'  => 'error',
                'mensaje' => 'Errores de validación en los datos enviados.',
                'errores' => $errors,
            ]);
        }

        if (createExpense($pdo, $userEmail, $concept, $amount)) {
            respondJson(201, [
                'estado'  => 'ok',
                'mensaje' => 'Gasto registrado correctamente.',
                'id'      => (int) $pdo->lastInsertId(),
            ]);
        }
        respondJson(500, ['estado' => 'error', 'mensaje' => 'No se pudo registrar el gasto.']);

    case 'DELETE':
        if ($id === null || $id <= 0) {
            respondJson(400, ['estado' => 'error', 'mensaje' => 'Debes indicar un id válido en la URL.']);
        }

        if (deleteExpense($pdo, $id, $userEmail)) {
            respondJson(200, ['estado' => 'ok', 'mensaje' => 'Gasto anulado correctamente.']);
        }
        respondJson(404, ['estado' => 'error', 'mensaje' => 'El gasto no existe, ya está liquidado o no eres su pagador.']);

    default:
        respondJson(405, ['estado' => 'error', 'mensaje' => 'Método HTTP no permitido para este recurso.']);
}