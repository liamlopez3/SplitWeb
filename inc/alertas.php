<?php

$catalogoAlertas = [
    // Usuarios
    'registro_ok'        => ['mensaje' => 'Registro completado. Ya puedes iniciar sesión.', 'clase' => 'alert-success'],
    'registro_invalido'  => ['mensaje' => 'Los datos del registro no son válidos.',          'clase' => 'alert-danger'],
    'registro_duplicado' => ['mensaje' => 'Ya existe una cuenta con ese email.',             'clase' => 'alert-danger'],
    'login_error'        => ['mensaje' => 'Email o contraseña incorrectos.',                 'clase' => 'alert-danger'],
    'logout_ok'          => ['mensaje' => 'Has cerrado sesión.',                             'clase' => 'alert-info'],

    // Gastos
    'gasto_creado'       => ['mensaje' => 'Gasto registrado correctamente.',                 'clase' => 'alert-success'],
    'gasto_invalido'     => ['mensaje' => 'Datos no válidos: el concepto es obligatorio (máx. 100 caracteres) y el importe debe ser positivo con 2 decimales como máximo.', 'clase' => 'alert-danger'],
    'gasto_error'        => ['mensaje' => 'No se pudo registrar el gasto.',                  'clase' => 'alert-danger'],
    'gasto_anulado'      => ['mensaje' => 'Gasto anulado correctamente.',                    'clase' => 'alert-success'],
    'gasto_anular_error' => ['mensaje' => 'No se pudo anular el gasto.',                     'clase' => 'alert-danger'],
    'liquidado'          => ['mensaje' => 'Cuentas liquidadas. Todos los saldos vuelven a 0 €.', 'clase' => 'alert-success'],

    // General
    'error_interno'      => ['mensaje' => 'Error interno. Inténtalo de nuevo más tarde.',    'clase' => 'alert-danger'],
];

$claveAlerta = $_GET['resultado'] ?? '';

if (is_string($claveAlerta) && array_key_exists($claveAlerta, $catalogoAlertas)) {
    $alerta = $catalogoAlertas[$claveAlerta];
    echo '<div class="alert ' . $alerta['clase'] . '" role="alert">' . e($alerta['mensaje']) . '</div>';
}