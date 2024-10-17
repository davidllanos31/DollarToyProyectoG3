<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;
use app\Validators\RolValidator;
use app\Data\RolData;


class VentasController {
    //Atributos para conexión bd
    private $validator;
    private $repository;

    public function __construct()
    {
        // $this->validator = new VentaValidator();
        $this->repository = new RolData();
    }

    public function index(){
        include __DIR__ . '/../views/pages/ventas/ventas.php';

    }
}



