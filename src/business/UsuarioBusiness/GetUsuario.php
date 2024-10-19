<?php

namespace app\Business\UsuarioBusiness;

use app\exceptions\DataException;
use app\Interfaces\UsuarioInterface;
use app\interfaces\ValidatorInterfaceActual;

class UsuarioGet
{
    private UsuarioInterface $usuario;
    private ValidatorInterfaceActual $validator;

    public function __construct(UsuarioInterface $usuario, ValidatorInterfaceActual $validator)
    {
        $this->usuario = $usuario;
        $this->validator = $validator;
    }

    public function find(array $filters): array
    {
        if (!$this->validator->validateFind(['id_rol' => null])) {
            throw new DataException($this->validator->getError());
        }

        $usuarios = $this->usuario->find($filters);

        if (empty($usuarios)) {
            if (isset($filters['id_rol'])) {
                throw new DataException('No se encontraron usuarios con el rol ' . $filters['id_rol']);
            }
            throw new DataException('No hay usuarios disponibles que coincidan con los criterios');
        }

        return $usuarios;
    }
}
