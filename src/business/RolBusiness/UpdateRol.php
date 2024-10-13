<?php

namespace app\Business\RolBusiness;

use app\Models\Rol;
use app\exceptions\ValidationException;
use app\interfaces\RolInterface;
use app\interfaces\ValidatorInterface;

class UpdateRol
{
    private RolInterface $rol;
    private ValidatorInterface $validator;

    public function __construct(RolInterface $rol, ValidatorInterface $validator)
    {
        $this->rol = $rol;
        $this->validator = $validator;
    }

    public function update(Rol $rol): bool
    {
        if (!$this->validator->validateUpdate($rol)) {
            throw new ValidationException($this->validator->getError());
        }

        return $this->rol->update($rol);
    }
}