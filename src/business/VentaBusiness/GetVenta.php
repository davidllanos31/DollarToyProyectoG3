<?php

namespace app\Business\VentaBusiness;

use app\Interfaces\VentaInterface;


class GetVenta{
    private $ventaRepository;
    public function __construct(VentaInterface $ventaRepository)
    {
        $this->ventaRepository = $ventaRepository;
    }

    public function get(): array
    {
        return $this->ventaRepository->get();
    }

}