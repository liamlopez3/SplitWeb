<?php
require_once __DIR__ . '/inc/codigo_inicializacion.php';
require_once __DIR__ . '/inc/plantilla.php';

define('PAGE_TITLE', 'Iniciar Sesión');
renderHeader('login');
?>

<div class="well">
  <form method="post" action="controlador-usuario.php">
    <input type="hidden" name="loginUser" value="1">

    <div class="form-group">
      <label for="fEmail">Email</label>
      <input type="email" class="form-control" id="fEmail" name="fEmail"
             maxlength="255" required autocomplete="email">
    </div>

    <div class="form-group">
      <label for="fPassword">Contraseña</label>
      <input type="password" class="form-control" id="fPassword" name="fPassword"
             maxlength="72" required autocomplete="current-password">
    </div>

    <button type="submit" class="btn btn-primary">Entrar</button>
  </form>

  <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
</div>

<?php
renderFooter();
require_once __DIR__ . '/inc/codigo_finalizacion.php';