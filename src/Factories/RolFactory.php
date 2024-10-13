<?php

namespace app\Factories;

use app\Models\Rol;

class RolFactory
{
    public static function create(?int $id, string $nombre): Rol
    {
        return new Rol($id, $nombre);
    }
}