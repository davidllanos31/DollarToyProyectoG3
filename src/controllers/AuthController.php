<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

class AuthController
{
    public function showLoginForm()
    {
        // Cargar la vista del formulario de login
        require_once __DIR__ . '/../views/login.php';
    }
    public function login()
    {
        // Procesar la autenticación
        // $username = $_POST['username'] ?? '';
        // $password = $_POST['password'] ?? '';

        header('Location: /DollarToyProyectoG3/home');
        exit();
    }
}
