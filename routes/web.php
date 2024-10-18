<?php
//ARCHIVO PARA MANEJAR RUTAS CON SU RESPECTIVO CONTROLLER

use app\Controllers\CategoriaController;
use app\Controllers\RolController;
use app\Controllers\SedesController;
use Grupo3\DollarToyProyectoG3\Controllers\HomeController;
use Grupo3\DollarToyProyectoG3\Controllers\AuthController;
use Grupo3\DollarToyProyectoG3\Controllers\UserController;
use Grupo3\DollarToyProyectoG3\Controllers\VentasController;
// use Grupo3\DollarToyProyectoG3\Controllers\SedesController;

return [
    '/' => [AuthController::class, 'showLoginForm'],
    '/login' => [AuthController::class, 'login'],
    // '/logout' => [AuthController::class, 'logout'],
    '/home' => [HomeController::class, 'index'],
    '/usuarios' => [UserController::class, 'index'],
    '/ventas' => [VentasController::class, 'index'],
    '/categorias' => [CategoriaController::class, 'index'],
    '/categorias/buscar' => [CategoriaController::class, 'buscar'], 
    '/categorias/editar' => [CategoriaController::class, 'update'],
    '/categorias/eliminar' => [CategoriaController::class, 'delete'],
    
    '/sedes' => [SedesController::class, 'index'],
    '/sedes/buscar' => [SedesController::class, 'buscar'],
    '/sedes/crear' => [SedesController::class, 'create'],
    '/roles' => [RolController::class, 'index'], 
    '/roles/buscar' => [RolController::class, 'buscar'], 
];
