<?php

namespace app\Business\RolBusiness;

use app\Interfaces\RolInterface;

class DeleteRol
{
    private $rolRepository;

    public function __construct(RolInterface $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function delete(int $id): bool
    {
        return $this->rolRepository->delete($id);
    }
}