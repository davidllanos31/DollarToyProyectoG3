<?php

namespace app\Business\VentaBusiness;

use app\Interfaces\VentaInterface;
use app\Models\Venta;

class AddVenta
{

    private VentaInterface $venta; //VentaData
    public function __construct(VentaInterface $repository)
    {
        $this->venta = $repository;
    }
    public function addVenta($id_usuario, $cliente, $fecha_venta, $metodo_pago, $total, $detalles): bool
    {

        return $this->venta->create($venta);
    }
}
