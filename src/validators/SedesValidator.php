<?php

namespace app\Validators;

use app\Interfaces\ValidatorInterfaceActual;

class SedesValidator implements ValidatorInterfaceActual
{
    private string $error;

    public function getError(): string
    {
        return $this->error;
    }

    public function validateFind(array $filters): bool
    {
        if (isset($filters['search']) && empty($filters['search'])) {
            $this->error = 'El parámetro search no puede estar vacío';
            return false;
        }

        if (isset($filters['id_sede']) && !is_int($filters['id_sede'])) {
            $this->error = 'El ID debe ser un número entero';
            return false;
        }       
        return true;
    }

    public function validateAdd(array $data = []): bool
    {
        if (empty($data)) {
            $this->error = 'Debe proporcionar los datos a crear';
            return false;
        }

        if (empty($data['nombre'])) {
            $this->error = 'El campo nombre es requerido';
            return false;
        }

        if (empty($data['direccion'])) {
            $this->error = 'El campo direccion es requerido';
            return false;
        }

        if (empty($data['telefono'])) {
            $this->error = 'El campo telefono es requerido';
            return false;
        }

        return true;
    }

    public function validateUpdate(array $data): bool
    {
        if (empty($data)) {
            $this->error = 'Debe proporcionar los datos a actualizar';
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

        if (empty($data['direccion'])) {
            $this->error = 'El campo direccion es requerido';
            return false;
        }

        if (empty($data['telefono'])) {
            $this->error = 'El campo telefono es requerido';
            return false;
        }

        return true;
    }

    public function validateId(?int $id): bool
    {
        if (empty($id)) {
            $this->error = 'Debe proporcionar el ID de la sede a actualizar';
            return false;
        }

        if (!is_int($id)) {
            $this->error = 'El ID debe ser un número entero';
            return false;
        }

        return true;
    }
}