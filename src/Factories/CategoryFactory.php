<?php

namespace app\Factories;

use app\Models\Categoria;

class CategoryFactory
{
    public static function create(?int $id, string $nombre, string $descripcion): Categoria
    {
        return new Categoria($id, $nombre, $descripcion);
    }
}