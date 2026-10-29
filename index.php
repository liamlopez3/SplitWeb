<?php
require_once __DIR__ . '/inc/codigo_inicializacion.php';

require_once RAIZ_FISICA . 'inc/plantilla.php';
require_once RAIZ_FISICA . 'src/modelos/usuario.php';
require_once RAIZ_FISICA . 'src/modelos/gasto.php';

$seccion = $_GET['seccion'] ?? 'expenses';

switch ($seccion){
    case 'expenses':
        define('PAGE_TITLE','Gastos');
        renderHeader('expenses');
        include RAIZ_FISICA . 'src/vistas/gasto/formulario.php';
        include RAIZ_FISICA . 'src/vistas/gasto/indice.php';
        renderFooter();
        break;
    
    case 'login':
        define('PAGE_TITLE','Iniciar sesión');
        renderHeader('login');
        include RAIZ_FISICA . 'src/vistas/usuario/login.php';
        renderFooter();
        break;

    case 'register':
        define('PAGE_TITLE','Registro');
        renderHeader('register');
        include RAIZ_FISICA . 'src/vistas/usuario/registro.php';
        renderFooter();
        break;

    default:
        http_response_code(404);
        define('PAGE_TITLE','Página no encontrada');
        renderHeader();
        echo '<div class="alert alert-danger"> La sección solicitada no existe.</div>';
        renderFooter();
        break;
}

require_once RAIZ_FISICA . 'inc/codigo_finalizacion.php';