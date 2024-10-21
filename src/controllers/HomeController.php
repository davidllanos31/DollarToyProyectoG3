<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

use app\Data\HomeData;

class HomeController
{

    private $repository;

    public function __construct()
    {
        // $this->validator = new VentaValidator();
        $this->repository = new HomeData();
    }
    public function index()
    {
        $title = "Dashboard";
        $content = __DIR__ . '/../views/home.php';
        try {
            $datosGrafico = $this->repository->getGraficosData();
            $ventasPorMesJSON = $datosGrafico['cantidad_ventas'];
            $ingresosPorMesJSON = $datosGrafico['suma_totales'];
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        include __DIR__ . '/../views/layouts/main.php'; // Layout completo para la carga inicial
    }
}
