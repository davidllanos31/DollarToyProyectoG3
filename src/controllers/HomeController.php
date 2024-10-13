<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

class HomeController
{
    public function index()
    {
        $title = "Dashboard";
        $content = __DIR__ . '/../views/home.php'; //CONTENIDO
        $data = "data";
        include __DIR__ . '/../views/layouts/main.php'; //Layout principal: tiene un navbar y footer, espera un CONTENIDO
    }
}
