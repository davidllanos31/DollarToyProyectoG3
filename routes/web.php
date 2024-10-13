<?php
//ARCHIVO PARA MANEJAR RUTAS CON SU RESPECTIVO CONTROLLER

use Grupo3\DollarToyProyectoG3\Controllers\HomeController;
use Grupo3\DollarToyProyectoG3\Controllers\AuthController;

return [
    '/' => [AuthController::class, 'showLoginForm'],
    // '/login' => [AuthController::class, 'login'],
    // '/logout' => [AuthController::class, 'logout'],
    '/home' => [HomeController::class, 'index'],
    // Agregar más rutas...
];
