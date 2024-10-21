<?php
$url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/../../partials/header.php';
var_dump($url);

switch ($url[0]) {
    default:
        switch ($url[1]) {
            default:
                switch ($url[3]) {
                    case 'crear':
                        require_once __DIR__ . '/registrarUsuarios.php';
                        break; // Asegúrate de añadir break aquí para salir del switch
                    default:
                        require_once __DIR__ . '/usuarios.php';
                        break;
                }
                break;
        }
        break;
}

require_once __DIR__ . '/../../partials/footer.php';
