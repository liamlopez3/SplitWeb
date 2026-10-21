<?php

$messages = [
	'registro_ok'		=> ['success', 'Registro completado. Ya puedes iniciar sesión.'],
	'registro_invalido'	=> ['danger', 'Los datos del registro no son válidos.'],
	'registro_duplicado'	=> ['danger', 'Ya existe una cuenta con ese email.'],
	'login_error'		=> ['danger', 'Email o contraseña incorrectos.'],
	'error_interno'		=> ['danger', 'Error interno. Inténtalo de nuevo más tarde.'],
	'logout_ok'		=> ['info', 'Has cerrado sesión.'],
	'gasto_creado'		=>['success', 'Gasto registrado.'],
	'gasto_anulado'		=>['success', 'Gasto anulado.'],
	'gasto_error'		=>['danger', 'No se pudo completar la operación con el gasto.'],
	'liquidado'		=>['success', 'Cuentas liquidadas. Todos los saldos vuelven a 0€.'],
];

$code = $_GET['resultado'] ?? '';
if (is_string($code) && isset($messages[$code])){
	[$type, $text] = $messages[$code];
	echo '<div class="alert alert-' . e($type) . '">' . e($text) . '</div>';
}
