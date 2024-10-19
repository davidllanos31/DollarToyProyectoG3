<?php

namespace app\interfaces;

use app\Models\Usuario;

interface UsuarioInterface
{
    public function find(array $filters): array;
    public function save(Usuario $usuario): bool;
    public function delete(int $id): bool;
    public function exists(int $id): bool;
}
