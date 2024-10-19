<?php

namespace app\Models;

class DetalleVenta
{
    public int $id_producto;
    public $cantidad;
    public $precio_unitario;

    public function __construct($id_producto, $cantidad, $precio_unitario)
    {
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio_unitario = $precio_unitario;
    }
}
