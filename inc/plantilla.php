<?php
function renderHeader($currentPage = '') { ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e(constant('PAGE_TITLE')) ?> · SplitWeb</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= RAIZ_URL ?>assets/css/style.css">
</head>
<body>
<header class="container">
  <div class="page-header">
    <h1>SplitWeb <small><?= e(constant('PAGE_TITLE')) ?></small></h1>
  </div>
</header>
<nav class="container">
  <ul class="nav nav-pills">
    <?php if (isset($_SESSION['user_email'])): ?>
      <li class="<?= $currentPage === 'expenses' ? 'active' : '' ?>"><a href="<?= RAIZ_URL ?>index.php?seccion=expenses">Gastos</a></li>
      <li class="<?= $currentPage === 'balance' ? 'active' : '' ?>"><a href="<?= RAIZ_URL ?>index.php?seccion=balance">Balance</a></li>
      <li><a href="#">Salir</a></li>    <?php else: ?>
      <li class="<?= $currentPage === 'login' ? 'active' : '' ?>"><a href="<?= RAIZ_URL ?>index.php?seccion=login">Entrar</a></li>
      <li class="<?= $currentPage === 'register' ? 'active' : '' ?>"><a href="<?= RAIZ_URL ?>index.php?seccion=register">Registrarse</a></li>
    <?php endif; ?>
  </ul>
</nav>
<main class="container">
<?php include __DIR__ . '/alertas.php'; ?>
<?php }

function renderFooter() { ?>
</main>
<footer class="container text-muted">
  <hr>
  <p>SplitWeb · Tecnologías Web · UVa</p>
</footer>
<script src="<?= RAIZ_URL ?>assets/js/app.js"></script>
</body>
</html>
<?php }
