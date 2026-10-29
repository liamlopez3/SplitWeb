<div class="well">
  <form method="post" action="<?= RAIZ_URL ?>src/controladores/usuario.php">
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

  <p>¿No tienes cuenta? <a href="<?= RAIZ_URL ?>index.php?seccion=register">Regístrate aquí</a></p>
</div>