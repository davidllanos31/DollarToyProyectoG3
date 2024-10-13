<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

class HomeController
{
    public function index()
    {
        $title = "Dashboard";
        $content = __DIR__ . '/../views/home.php';

        if ($this->isAjaxRequest()) {
            include $content; // Solo el contenido para AJAX
        } else {
            include __DIR__ . '/../views/layouts/main.php'; // Layout completo para la carga inicial
        }
    }
    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
