<?php

$errors   = $_SESSION['register_errors'] ?? [];
$formData = $_SESSION['register_data'] ?? [];
unset($_SESSION['register_errors'], $_SESSION['register_data']);
?>

<div class="well">
  <form id="formRegister" method="post" action="<?= RAIZ_URL ?>src/controladores/usuario.php">
    <input type="hidden" name="registerUser" value="1">

    <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
      <label for="fEmail" class="control-label">Email</label>
      <input type="email" class="form-control" id="fEmail" name="fEmail" maxlength="255" required
             value="<?= e($formData['email'] ?? '') ?>">
      <?php if (isset($errors['email'])): ?>
        <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['email']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group <?= isset($errors['fullName']) ? 'has-error' : '' ?>">
      <label for="fFullName" class="control-label">Nombre completo</label>
      <input type="text" class="form-control" id="fFullName" name="fFullName" maxlength="255" required
             value="<?= e($formData['fullName'] ?? '') ?>">
      <?php if (isset($errors['fullName'])): ?>
        <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['fullName']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group <?= isset($errors['nickname']) ? 'has-error' : '' ?>">
      <label for="fNickname" class="control-label">Alias</label>
      <input type="text" class="form-control" id="fNickname" name="fNickname" maxlength="255" required
             value="<?= e($formData['nickname'] ?? '') ?>">
      <?php if (isset($errors['nickname'])): ?>
        <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['nickname']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
      <label for="fPassword" class="control-label">Contraseña (mínimo 8 caracteres)</label>
      <input type="password" class="form-control" id="fPassword" name="fPassword"
             minlength="8" maxlength="72" required autocomplete="new-password">
      <?php if (isset($errors['password'])): ?>
        <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['password']) ?></span>
      <?php endif; ?>
    </div>

    <div class="form-group <?= isset($errors['password2']) ? 'has-error' : '' ?>">
      <label for="fPassword2" class="control-label">Repite la contraseña</label>
      <input type="password" class="form-control" id="fPassword2" name="fPassword2"
             minlength="8" maxlength="72" required autocomplete="new-password">
      <?php if (isset($errors['password2'])): ?>
        <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['password2']) ?></span>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Registrarme</button>
  </form>

  <p>¿Ya tienes cuenta? <a href="<?= RAIZ_URL ?>index.php?seccion=login">Inicia sesión</a></p>
</div>