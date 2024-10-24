<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/views/includes/session_start.php';

if (isset($_GET['views'])) {
    $url = explode('/', $_SERVER['views']);
} else {
    $url = ["login"];
}

$routes = require_once __DIR__ . '/../routes/web.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($uri, BASE_URI) === 0) {
    $uri = substr($uri, strlen(BASE_URI));
}

if (array_key_exists($uri, $routes)) {
    [$controller, $metodo] = $routes[$uri];
    $controllerObjeto = new $controller();
    $controllerObjeto->$metodo();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Página no encontrada";
}
