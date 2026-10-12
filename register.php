<?php

require_once 'inc/init.php';
require_once 'inc/template.php';

define('PAGE_TITLE','Registro');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$nombre = trim($_POST['nombre'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$password = $_POST['password'] ?? '';

	if (empty($nombre) || empty($email) || empty($password)){
		$error = 'Por favor, rellene todos los campos.';
	} else {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		try {
			$stmt = $pdo -> prepare('INSERT INTO usuarios (nombre,email,password) VALUES (?,?,?)');
			$stmt->execute([$nombre, $email, $hashed_password]);

			$success = 'Cuenta creada con éxito. Ya puede iniciar sesión.';
		} catch (PDOException $e) {

			if ($e->getCode() == 23000) {
				$error = 'Este email ya está registrado.';
			} else {
				$error = 'Error en la base de datos: ' . $e->getMessage();
			}
		}
	}
}

renderHeader();
?>

<!-- 5. Contenido HTLM: El formulario -->
<h2>Crea tu cuenta en SplitWeb</h2>

<!-- Mostrar mensajes de error o éxito si existen -->
<?php if ($error): ?>
	<p style="color: red; font-weight:bold;"><?= e($error) ?></p>
<?php endif; ?>

<?php if ($success): ?>
	<p style="color: green; font-weight:bold;"><?= e($success) ?></p>
<?php endif; ?>

<!-- Formulario que se envía a sí mismo (register.php) mediante el método POST -->
<form method="POST" action="register.php">
	<div>
		<label for="nombre">Nombre:</label><br>
		<input type="text" id="nombre" name="nombre" required>
	</div>
	<br>
	<div>
		<label for="email">Correo Electrónico:</label><br>
		<input type="email" id="email" name="email" required>
	</div>
	<br>
	<div>
		<label for="password">Contraseña:</label><br>
		<input type="password" id="password" name="password" required>
	</div>
	<br>
	<button type="submit">Registrarse</button>
</form>

<p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>

<?php
renderFooter();
?>
