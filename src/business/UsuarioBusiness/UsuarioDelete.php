<?php

namespace app\Business\UsuarioBusiness;

use app\Exceptions\DataException;
use app\Interfaces\UsuariosInterface;

class UsuarioDelete
{
    private UsuariosInterface $usuario;

    public function __construct(UsuariosInterface $usuario)
    {
        $this->usuario = $usuario;
    }

    public function deleteById(int $id = null): bool
    {
        if (!$id) {
            throw new DataException('Debe proporcionar el ID del usuario a eliminar');
        }

        if (!$this->usuario->exists($id)) {
            throw new DataException('Usuario con id ' . $id . ' no encontrado');
        }

        return $this->usuario->delete($id);
    }
}
