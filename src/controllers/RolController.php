<?php

namespace app\Controllers;

use app\Interfaces\RolInterface;

class RolController
{
    private RolInterface $rol;

    public function __construct(RolInterface $rol)
    {
        $this->rol = $rol;
    }

    public function index()
    {
        $rols = $this->rol->get();
        $title = 'Lista de Roles';
        $content = __DIR__ . '/../views/pages/roles/index.php';
        include __DIR__ . '/../views/layouts/main.php';
    }

    public function create()
    {
        $title = 'Crear Role';
    }
}