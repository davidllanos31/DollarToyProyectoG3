<?php
//ARCHIVO PARA MANEJAR RUTAS CON SU RESPECTIVO CONTROLLER

use app\Controllers\CategoriaController;
use Grupo3\DollarToyProyectoG3\Controllers\HomeController;
use Grupo3\DollarToyProyectoG3\Controllers\AuthController;
use Grupo3\DollarToyProyectoG3\Controllers\UserController;
use Grupo3\DollarToyProyectoG3\Controllers\VentasController;

return [
    '/' => [AuthController::class, 'showLoginForm'],
    '/login' => [AuthController::class, 'login'],
    // '/logout' => [AuthController::class, 'logout'],
    '/home' => [HomeController::class, 'index'],
    '/usuarios' => [UserController::class, 'index'],
    '/ventas' => [VentasController::class, 'index'],
    // Agregar más rutas...
    '/categorias' => [CategoriaController::class, 'index'],
    '/categorias/buscar' => [CategoriaController::class, 'buscar'], 
];
