<?php
require_once __DIR__ . '/inc/codigo_inicializacion.php';
require_once __DIR__ . '/inc/plantilla.php';

define('PAGE_TITLE', 'Inicio');

renderHeader();
?>

<h2>¡Bienvenido a SplitWeb!</h2>
<p>Esta es la página principal de la aplicación.</p>
<p><a href="register.php">Ir al formulario de registro</a></p>

<?php
renderFooter();
require_once __DIR__ . '/inc/codigo_finalizacion.php';
