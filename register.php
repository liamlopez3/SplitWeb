<?php
require_once __DIR__ . '/inc/codigo_inicializacion.php';
require_once __DIR__ . '/inc/plantilla.php';

define('PAGE_TITLE', 'Registro');
renderHeader('register');
?>

<div class="well">
  <form method="post" action="controlador-usuario.php">
    <input type="hidden" name="registerUser" value="1">

    <div class="form-group">
      <label for="fEmail">Email</label>
      <input type="email" class="form-control" id="fEmail" name="fEmail" maxlength="255" required>
    </div>
    <div class="form-group">
      <label for="fFullName">Nombre completo</label>
      <input type="text" class="form-control" id="fFullName" name="fFullName" maxlength="255" required>
    </div>
    <div class="form-group">
      <label for="fNickname">Alias</label>
      <input type="text" class="form-control" id="fNickname" name="fNickname" maxlength="255" required>
    </div>
    <div class="form-group">
      <label for="fPassword">Contraseña (mínimo 8 caracteres)</label>
      <input type="password" class="form-control" id="fPassword" name="fPassword" minlength="8" maxlength="72" required autocomplete="new-password">
    </div>
    <div class="form-group">
      <label for="fPassword2">Repite la contraseña</label>
      <input type="password" class="form-control" id="fPassword2" name="fPassword2" minlength="8" maxlength="72" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Registrarme</button>
  </form>
</div>

<?php
renderFooter();
require_once __DIR__ . '/inc/codigo_finalizacion.php';
