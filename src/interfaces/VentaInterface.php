<?php

namespace app\Interfaces;

use app\Models\Venta;

interface VentaInterface
{
    public function create(Venta $venta): bool;
    public function get(array $filters): array;
    public function update(Venta $venta): bool;
    public function delete(int $id): bool;
    public function getById(int $id): ?Venta;
}
