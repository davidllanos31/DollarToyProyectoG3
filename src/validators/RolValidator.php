<?php

namespace app\Validators;

use app\Interfaces\ValidatorInterface;
use app\Models\Rol;

class RolValidator implements ValidatorInterface
{
    private string $error;

    public function getError(): string
    {
        return $this->error;
    }

    public function validateAdd(Rol $rol): bool
    {
        if (empty($rol->getNombre())) {
            $this->error = 'El nombre del rol no puede estar vacío';
            return false;
        }

        return true;
    }

    public function validateUpdate(Rol $rol): bool
    {
        if (empty($rol->getId())) {
            $this->error = 'El ID del rol no puede estar vacío';
            return false;
        }

        if (empty($rol->getNombre())) {
            $this->error = 'El nombre del rol no puede estar vacío';
            return false;
        }

        return true;
    }
}
