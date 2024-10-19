<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

use app\Business\VentaBusiness\GetVenta;
use app\Data\VentaData;

class VentaController {
    //Atributos para conexión bd
    private $validator;//opcional
    private $repository;

    public function __construct()
    {
        // $this->validator = new VentaValidator();
        $this->repository = new VentaData();
    }

    public function index(){
        
        $getVenta = new GetVenta($this->repository);
        $ventas = $getVenta->get();
        $content =__DIR__ . '/../views/pages/ventas/listarVentas.php';
        $title = 'Listado de Ventas';
        if ($this->isAjaxRequest()) {
            include $content; // Solo el contenido para AJAX
        } else {
            include __DIR__ . '/../views/layouts/main.php'; // Layout completo para la carga inicial
        }
    }

    public function nuevaVenta(){
        // $getVenta = new GetVenta($this->repository);
        // $ventas = $getVenta->get();
        $title = 'Registrar Venta';
        $content =__DIR__ . '/../views/pages/ventas/registrarVenta.php';
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



