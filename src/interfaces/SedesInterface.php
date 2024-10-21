<?php
namespace app\interfaces;
use app\Models\Sedes;

interface SedesInterface
{
    public function find(array $filters): array;
    public function create(Sedes $sedes): bool;
    public function delete(int $id): bool;
    public function exists(int $id): bool;
}
