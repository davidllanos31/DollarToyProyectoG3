<?php

namespace app\Business\RolBusiness;

use app\Interfaces\RolInterface;

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
        return $this->rolRepository->exists($id) ? $this->rolRepository->getById($id) : null;
    }
}
