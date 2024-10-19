<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

use app\Business\UsuarioBusiness\GetUsuario;
use app\Data\UsuarioData;

class UsuarioController
{
    private UsuarioData $repository;

    public function __construct()
    {
        $this->repository = new UsuarioData();
    }

    public function index()
    {
        // Instanciamos GetUsuario para obtener la lista de usuarios
        $getUsuario = new GetUsuario($this->repository);
        $usuarios = $getUsuario->get(); // Obtener la lista de usuarios

        // Definimos la ruta de la vista
        $content = __DIR__ . '/../views/usuarios.php';
        $title = 'Listado de Usuarios'; // Definimos el título de la vista

        // Verificamos si la petición es AJAX
        if ($this->isAjaxRequest()) {
            // Solo se incluye el contenido para peticiones AJAX
            include $content;
        } else {
            // Incluimos la vista principal que contiene el layout y el contenido
            include __DIR__ . '/../views/layouts/main.php';
        }
    }

    private function isAjaxRequest(): bool
    {
        // Verifica si la solicitud es AJAX
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
