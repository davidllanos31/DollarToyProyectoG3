<?php

require __DIR__ . '/../vendor/autoload.php';

use app\Controllers\RolController;
use app\Data\RolData;

$requestUri = $_SERVER['REQUEST_URI'];
$projectFolder = '/DollarToyProyectoG3';
$baseUrl = $projectFolder;

$uri = str_replace($projectFolder, '', $requestUri);

$rolRepository = new RolData();
$rolController = new RolController($rolRepository);

$viewPath = __DIR__ . '/views/';

switch ($uri) {
    case '/':
        $title = 'Inicio';
        require $viewPath . 'users.php';
        break;
    case '/usuarios':
        $title = 'Usuarios';
        require $viewPath . 'users.php';
        break;
    case '/roles':
        $rolController->index();
        break;
    default:
        $title = 'Inicio';
        require $viewPath . 'users.php';
        break;
}