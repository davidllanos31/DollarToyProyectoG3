<?php

namespace app\Validators;

use app\Interfaces\ValidatorInterfaceActual;

class UsuarioValidator implements ValidatorInterfaceActual
{
    private string $error;

    public function getError(): string
    {
        return $this->error;
    }

    public function validateFind(array $filters): bool
    {
        if (isset($filters['search']) && empty($filters['search'])) {
            $this->error = 'El parámetro de búsqueda no puede estar vacío';
            return false;
        }

        if (isset($filters['id_rol']) && !is_int($filters['id_rol'])) {
            $this->error = 'El ID del rol debe ser un número entero';
            return false;
        }

        return true;
    }

    public function validateAdd(array $data = []): bool
    {
        if (empty($data)) {
            $this->error = 'Debe proporcionar los datos del usuario a crear';
            return false;
        }

        if (empty($data['nombre'])) {
            $this->error = 'El campo nombre es requerido';
            return false;
        }

        if (empty($data['apellido'])) {
            $this->error = 'El campo apellido es requerido';
            return false;
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Debe proporcionar un correo electrónico válido';
            return false;
        }

        if (empty($data['celular'])) {
            $this->error = 'El campo celular es requerido';
            return false;
        }

        if (empty($data['rol'])) {
            $this->error = 'El campo rol es requerido';
            return false;
        }

        return true;
    }

    public function validateUpdate(array $data): bool
    {
        if (empty($data)) {
            $this->error = 'Debe proporcionar los datos del usuario a actualizar';
            return false;
        }

        if (empty($data['id'])) {
            $this->error = 'El campo id es requerido';
            return false;
        }

        if (empty($data['nombre'])) {
            $this->error = 'El campo nombre es requerido';
            return false;
        }

        if (empty($data['apellido'])) {
            $this->error = 'El campo apellido es requerido';
            return false;
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Debe proporcionar un correo electrónico válido';
            return false;
        }

        if (empty($data['celular'])) {
            $this->error = 'El campo celular es requerido';
            return false;
        }

        if (empty($data['rol'])) {
            $this->error = 'El campo rol es requerido';
            return false;
        }

        return true;
    }

    public function validateId(?int $id): bool
    {
        if (empty($id)) {
            $this->error = 'Debe proporcionar el ID del usuario';
            return false;
        }

        if (!is_int($id)) {
            $this->error = 'El ID debe ser un número entero';
            return false;
        }

        return true;
    }
}
