<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/config/database.php';
use app\routes\Router;

$router = new Router();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/DollarToyProyectoG3', '', $uri);


$router->get('/', [app\Controllers\RolController::class, 'index']);
$router->get('/roles', [app\Controllers\RolController::class, 'index']);
$router->get('/roles/create', [app\Controllers\RolController::class, 'create']);
$router->post('/roles/store', [app\Controllers\RolController::class, 'store']);
$router->get('/roles/edit/{id}', [app\Controllers\RolController::class, 'edit']);
$router->post('/roles/update/{id}', [app\Controllers\RolController::class, 'update']);
$router->get('/roles/delete/{id}', [app\Controllers\RolController::class, 'delete']);

$router->run();

// $routes = require_once __DIR__ . '/../routes/web.php'; // TODAS LA RUTAS
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// $baseUri = '/DollarToyProyectoG3';
// if (strpos($uri, $baseUri) === 0) {
//     $uri = substr($uri, strlen($baseUri));
// }
// // VERIFICAR LA RUTA
// if (array_key_exists($uri, $routes)) {
//     [$controller, $method] = $routes[$uri]; //usa el controlador de la ruta
//     $controllerInstance = new $controller();
//     $controllerInstance->$method();
// } else {
//     // Manejar 404
//     header("HTTP/1.0 404 Not Found");
//     echo "Página no encontrada";
//     $log->warning("Ruta no encontrada: {$uri}");
// }
