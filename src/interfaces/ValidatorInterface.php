<?php

namespace app\interfaces;

use app\Models\Rol;

interface ValidatorInterface
{
    public function getError(): string;
    public function validateAdd(Rol $data): bool;
    public function validateUpdate(Rol $data): bool;
}