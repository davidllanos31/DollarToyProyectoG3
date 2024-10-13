<?php

namespace app\Business\RolBusiness;

use app\exceptions\DataException;
use app\Interfaces\RolInterface;
use app\Models\Rol;
use app\exceptions\ValidationException;
use app\interfaces\ValidatorInterface;

class GetRol
{
    private $rolRepository;

    public function __construct(RolInterface $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function get(): array
    {
        return $this->rolRepository->get();
    }

    public function getById(int $id)
    {
        $rol = $this->rolRepository->exists($id);
        if ($rol === null) {
            throw new DataException('No existe el rol con el ID ' . $id);
        }
        return $rol;
    }
}
