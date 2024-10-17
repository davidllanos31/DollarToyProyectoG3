<?php

namespace app\interfaces;

use app\Models\Categoria;

interface CategoriaInterface
{
    public function find(array $filters): array;
    public function save(Categoria $categoria): bool;
    public function delete(int $id): bool;
    public function exists(int $id): bool;
}