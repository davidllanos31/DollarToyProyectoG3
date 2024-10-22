
<?php
$url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];
require_once __DIR__ . '/../../partials/header.php';

switch ($url[2] ?? '') {
    case 'usuarios':
        // Verificar si el índice 3 está definido y es 'crear'
        if (isset($url[3]) && $url[3] === 'crear') {
            require_once __DIR__ . '/registrarUsuarios.php'; // Cambia el archivo según tu lógica
        } else {
            require_once __DIR__ . '/usuarios.php';
        }
        break;
    default:
        // Manejar otras rutas o redirigir
        require_once __DIR__ . '/not_found.php'; // O cualquier otra lógica que desees
        break;
}

require_once __DIR__ . '/../../partials/footer.php';    