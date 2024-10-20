<?php

namespace app\Factories;

use app\Models\Usuario;

class UserFactory
{
    public static function create(
        ?int $id,
        string $nombre,
        string $apellido,
        string $email,
        string $celular,
        string $fechaRegistro,
        string $rol
    ): Usuario {
        return new Usuario($id, $nombre, $apellido, $email, $celular, $fechaRegistro, $rol);
    }
}
