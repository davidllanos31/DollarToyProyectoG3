<?php

namespace app\Interfaces;

use app\Models\Rol; // Importar la clase Rol

interface RolInterface
{
    public function create(Rol $rol): bool; // Usar la clase Rol aquí
    public function get(): array;
    public function update(Rol $rol): bool; // Usar la clase Rol aquí
    public function delete(int $id): bool;
    public function exists(int $id): bool;
    public function getById(int $id): ?Rol;
}
