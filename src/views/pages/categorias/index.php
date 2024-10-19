<?php
$url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

// require_once __DIR__ . '/../../partials/header.php';

switch ($url[0]) {

    default:
        switch ($url[1]) {
            default:
                require_once __DIR__ . '/categorias.php';
                break;
        }
        break;
}

// require_once __DIR__ . '/../../partials/footer.php';
