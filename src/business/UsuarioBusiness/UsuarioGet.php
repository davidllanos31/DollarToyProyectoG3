<?php

namespace app\Business\UsuarioBusiness;

use app\exceptions\DataException;
use app\Interfaces\UsuariosInterface;
use app\interfaces\ValidatorInterfaceActual;

class UsuarioGet
{
    private UsuariosInterface $usuario;
    private ValidatorInterfaceActual $validator;

    public function __construct(UsuariosInterface $usuario, ValidatorInterfaceActual $validator)
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
            if (isset($filters['id'])) {
                throw new DataException('Usuario con id ' . $filters['id'] . ' no encontrado');
            }
            if (isset($filters['nombre'])) {
                throw new DataException('No se encontró ningún usuario con el nombre "' . $filters['nombre'] . '"');
            }
            if (isset($filters['email'])) {
                throw new DataException('No se encontró ningún usuario con el email "' . $filters['email'] . '"');
            }
            throw new DataException('No hay usuarios disponibles que coincidan con los criterios');
        }

        return $usuarios;
    }
}
