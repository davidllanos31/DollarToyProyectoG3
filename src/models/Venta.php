<?php

namespace app\Models;

class Venta
{
    public $id_usuario; //vendedor
    public $cliente;
    public string $fecha_venta;
    public string $id_metodopago;
    public float $total;
    public $detalles = [];

    public function __construct($id_usuario, $cliente, $fecha_venta, $id_metodopago, $total, $detalles)
    {
        $this->id_usuario = $id_usuario;
        $this->cliente = $cliente;
        $this->fecha_venta = $fecha_venta;
        $this->id_metodopago = $id_metodopago;
        $this->total = $total;
        $this->detalles = $detalles;
    }
}
