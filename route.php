<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$method = $_SERVER["REQUEST_METHOD"];
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Ruta base 
$base = '/TFG'; 
$ruta = str_replace($base, '', $request);

switch ($method) {
    case 'GET':
        switch ($ruta) {
            case '':
            case '/':
            case '/home':
                require 'views/home.php';
                break;
            case '/registro':
                require 'views/registro_exitoso.php';
                break;
            case '/panel_usuario':
                require 'views/panel_usuario.php';
                break;
            case '/panel_admin':
                require 'views/panel_admin.php';
                break;
            case '/gestionar_hijos':
                require 'controllers/gestionarHijosController.php';
                break;
            case '/gestionar_calendarios':
                require 'controllers/gestionarCalendariosController.php';
                break;
            case '/gestionar_usuarios':
                require 'controllers/usuariosGestionController.php';
                break;
            case '/calendario_usuario':
                require 'controllers/calendarioUsuarioController.php';
                break;
            case '/efectos_secundarios':
                require 'views/efectosSecundarios.php';
                break;
            case '/calculadora_dosis':
                require 'views/calculadoraDosis.php';
                break;
            case '/sobre_nosotros':
                require 'views/sobreNosotros.php';
                break;
            default:
                http_response_code(404);
                require 'views/404.php';
                break;
        }
        break;

    case 'POST':
        switch ($ruta) {
            case '/login':
                require 'controllers/procesarLogin.php';
                break;
            case '/registro':
                require 'controllers/procesarRegistro.php';
                break;
            case '/logout':
                require 'controllers/logout.php';
                break;
            case '/actualizar_perfil':
                require 'controllers/editarPerfilController.php';
                break;
            case '/eliminar_cuenta':
                require 'controllers/eliminarCuentaController.php';
                break;
            default:
                http_response_code(405);
                echo "Método POST no permitido para esta ruta.";
                break;
        }
        break;

    default:
        http_response_code(405);
        echo "Método no permitido.";
        break;
}
