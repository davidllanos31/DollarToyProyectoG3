<?php

require __DIR__ . '/../vendor/autoload.php'; //Autoloader
require __DIR__ . '/config/database.php';

$routes = require_once __DIR__ . '/../routes/web.php'; // TODAS LA RUTAS
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseUri = '/DollarToyProyectoG3';
define('BASE_URI', $baseUri);

if (strpos($uri, $baseUri) === 0) {//quita dollartoy de la ruta
    $uri = substr($uri, strlen($baseUri));
}
// VERIFICAR LA RUTA
if (array_key_exists($uri, $routes)) {
    [$controller, $metodo] = $routes[$uri]; //usa el controlador de la ruta
    $controllerObjeto = new $controller();
    $controllerObjeto->$metodo();
} else {
    // Manejar 404
    header("HTTP/1.0 404 Not Found");
    echo "Página no encontrada";
    // $log->warning("Ruta no encontrada: {$uri}");
}
