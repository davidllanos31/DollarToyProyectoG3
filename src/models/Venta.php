<?php

namespace app\Models;

class Venta
{
    public string $nombre_cliente;
    public string $nombre_vendedor;
    public string $nombre_producto;
    public int $cantidad;
    public string $fecha_venta;
    public string $metodo_pago;
    public float $total;

    public function __construct(
        string $nombre_cliente,
        string $nombre_vendedor,
        string $nombre_producto,
        int $cantidad,
        string $fecha_venta,
        string $metodo_pago,
        float $total
    ) {
        $this->nombre_cliente = $nombre_cliente;
        $this->nombre_vendedor = $nombre_vendedor;
        $this->nombre_producto = $nombre_producto;
        $this->cantidad = $cantidad;
        $this->fecha_venta = $fecha_venta;
        $this->metodo_pago = $metodo_pago;
        $this->total = $total;
    }
}
