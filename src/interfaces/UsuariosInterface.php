<?php

namespace app\Interfaces;

use app\Models\Usuario;

interface UsuariosInterface
{
    public function find(array $filters): array;
    public function save(Usuario $usuario): bool;
    public function delete(int $id): bool;
    public function exists(int $id): bool;
}
