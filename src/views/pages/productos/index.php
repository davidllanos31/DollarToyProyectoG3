<?php
$url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/../../partials/header.php';

// Usar el índice 2 para productos
switch ($url[2] ?? '') {
    case 'productos':
        // Verificar si el índice 3 está definido y es 'crear'
        if (isset($url[3]) && $url[3] === 'crear') {
            require_once __DIR__ . '/create.php';
        } else {
            require_once __DIR__ . '/productos.php';
        }
        break;
    default:
        // Manejar otras rutas o redirigir
        require_once __DIR__ . '/not_found.php'; // O cualquier otra lógica que desees
        break;
}

require_once __DIR__ . '/../../partials/footer.php';