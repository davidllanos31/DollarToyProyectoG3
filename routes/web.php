<?php
//ARCHIVO PARA MANEJAR RUTAS CON SU RESPECTIVO CONTROLLER

use app\Controllers\CategoriaController;
use app\Controllers\RolController;
use app\Controllers\SedesController;
use Grupo3\DollarToyProyectoG3\Controllers\HomeController;
use Grupo3\DollarToyProyectoG3\Controllers\AuthController;
use Grupo3\DollarToyProyectoG3\Controllers\UserController;
use Grupo3\DollarToyProyectoG3\Controllers\VentaController;
use app\Controllers\ProductoController;
use app\Controllers\UsuarioController;
use app\Models\Usuario;
use Grupo3\DollarToyProyectoG3\Controllers\InicioController;

// use Grupo3\DollarToyProyectoG3\Controllers\SedesController;

return [
    '/' => [InicioController::class, 'index'],
    '/iniciar-sesion' => [AuthController::class, 'showLoginForm'],
    '/login' => [AuthController::class, 'login'],
    // '/logout' => [AuthController::class, 'logout'],
    '/home' => [HomeController::class, 'index'],
    '/usuarios' => [UsuarioController::class, 'index'],
    '/usuarios/crear' => [UsuarioController::class, 'create'],
    '/usuarios/registrar' => [UsuarioController::class, 'store'],
    '/usuarios/eliminar' => [UsuarioController::class, 'delete'],
    '/ventas' => [VentaController::class, 'index'],
    '/ventas/crear' => [VentaController::class, 'nuevaVenta'],
    '/ventas/registrar' => [VentaController::class, 'registrarVenta'],
    '/ventas/buscar' => [VentaController::class, 'buscar'],
    '/categorias' => [CategoriaController::class, 'index'],
    '/categorias/buscar' => [CategoriaController::class, 'buscar'],
    '/categorias/editar' => [CategoriaController::class, 'update'],
    '/categorias/eliminar' => [CategoriaController::class, 'delete'],

    '/sedes' => [SedesController::class, 'index'],
    '/sedes/buscar' => [SedesController::class, 'buscar'],
    '/sedes/crear' => [SedesController::class, 'nuevaSede'],
    '/sedes/store' => [SedesController::class, 'store'],
    '/sedes/editar' => [SedesController::class, 'edit'],
    '/sedes/eliminar' => [SedesController::class, 'delete'],
    '/roles' => [RolController::class, 'index'],
    '/roles/buscar' => [RolController::class, 'buscar'],

    '/productos' => [ProductoController::class, 'index'],
    '/productos/buscar' => [ProductoController::class, 'buscar'],
    '/productos/crear' => [ProductoController::class, 'nuevoProducto'],
    '/productos/store' => [ProductoController::class, 'store'],
];
