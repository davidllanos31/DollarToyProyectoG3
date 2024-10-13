<?php
//ARCHIVO PARA MANEJAR RUTAS CON SU RESPECTIVO CONTROLLER

use Grupo3\DollarToyProyectoG3\Controller\HomeController;
use Grupo3\DollarToyProyectoG3\Controller\AuthController;

return [
    '/' => [AuthController::class, 'showLoginForm'],
    // '/login' => [AuthController::class, 'login'],
    // '/logout' => [AuthController::class, 'logout'],
    '/home' => [HomeController::class, 'index'],
    // Agregar más rutas...
];
