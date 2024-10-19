<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

use app\Business\VentaBusiness\AddVenta;
use app\Business\VentaBusiness\GetVenta;
use app\Data\VentaData;
use app\Models\DetalleVenta;
use app\Models\Venta;

class VentaController
{
    //Atributos para conexión bd
    private $validator; //opcional
    private $repository;

    public function __construct()
    {
        // $this->validator = new VentaValidator();
        $this->repository = new VentaData();
    }

    public function index()
    {

        $getVenta = new GetVenta($this->repository);
        $ventas = $getVenta->get();
        $content = __DIR__ . '/../views/pages/ventas/listarVentas.php';
        $title = 'Listado de Ventas';
        if ($this->isAjaxRequest()) {
            include $content; // Solo el contenido para AJAX
        } else {
            include __DIR__ . '/../views/layouts/main.php'; // Layout completo para la carga inicial
        }
    }

    public function nuevaVenta()
    {
        $title = 'Registrar Venta';
        $content = __DIR__ . '/../views/pages/ventas/registrarVenta.php';
        if ($this->isAjaxRequest()) {
            include $content; // Solo el contenido para AJAX
        } else {
            include __DIR__ . '/../views/layouts/main.php'; // Layout completo
        }
    }

    public function registrarVenta()
    {
        try {
            $id_usuario = $_POST['id_usuario'];
            $cliente = $_POST['cliente'];
            $fecha_venta = $_POST['fecha_venta'];
            $id_metodopago = $_POST['id_metodopago'];
            $total = $_POST['total'];
            $detalles = [];
            foreach ($_POST['detalles'] as $index => $id_producto) {
                $detalles[] = new DetalleVenta(
                    $id_producto,
                    $_POST['cantidad_detalle'][$index],
                    $_POST['precio_unitario'][$index]
                );
            }

            $venta = new Venta($id_usuario, $cliente, $fecha_venta, $id_metodopago, $total, $detalles);
            $registrar_venta = $this->repository->create($venta);
            if ($registrar_venta) {
                echo ("venta registrada");
            }
        } catch (\Exception $e) {
            echo "Error al guardar la venta: " . $e->getMessage();
        }
    }


    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
