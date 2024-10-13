<?php

namespace Grupo3\DollarToyProyectoG3\controller;

class AuthController
{
    public function showLoginForm()
    {
        // Cargar la vista del formulario de login
        require_once __DIR__ . '/../view/login.php';
    }
}
