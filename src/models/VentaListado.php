<?php

namespace app\Models;

class VentaListado
{
    public $id_venta;
    public $nombre_usuario;
    public $cliente;
    public $fecha_venta;
    public $nombre_metodopago;
    public $total;

    public function __construct($id_venta, $nombre_usuario, $cliente, $fecha_venta, $nombre_metodopago, $total)
    {
        $this->id_venta = $id_venta;
        $this->nombre_usuario = $nombre_usuario;
        $this->cliente = $cliente;
        $this->fecha_venta = $fecha_venta;
        $this->nombre_metodopago = $nombre_metodopago;
        $this->total = $total;
    }
}
