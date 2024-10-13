<?php

require __DIR__ . '/../vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];

$projectFolder = '/DollarToyProyectoG3';
$baseUrl = $projectFolder;

$uri = str_replace($projectFolder, '', $requestUri);

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
    default:
        $title = 'Inicio';
        require $viewPath . 'users.php';
        break;
}