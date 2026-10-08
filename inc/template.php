<?php
function e(?string $text): string
{
	return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

function renderHeader(){ ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= e(constant('PAGE_TITLE')) ?> · SplitWeb</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
	<h1><?= e(constant('PAGE_TITLE')) ?></h1>
	<nav>
		<ul>
			<?php if (isset($_SESSION['user_email'])): ?>
				<li><a href="expenses.php">Gastos</a></li>
				<li><a href="balance.php">Balance</a></li>
				<li><a href="logout.php">Salir</a></ li>
			<?php else: ?>
				<li><a href="login.php">Entrar</a></li>
				<li><a href="register.php">Registrarse</a></li>
			<?php endif; ?>
		</ul>
	</nav>

</header>
<main>
<?php }

function renderFooter() { ?>
</main>
<footer><p>SplitWeb · Tecnologías Web · UVa</p></footer>
<script src="js/app.js"></script>
</body>
</html>
<?php }
