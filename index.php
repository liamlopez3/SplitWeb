<?php
require_once 'inc/init.php';
require_once 'inc/template.php';

define('PAGE_TITLE', 'Inicio · SplitWeb');

renderHeader();
?>

<h2>¡Bienvenido a SplitWeb!</h2>
<p>Esta es la página principal de la aplicación.</p>
<p><a href="register.php">Ir al formulario de registro</a></p>

<?php
renderFooter();
?>
