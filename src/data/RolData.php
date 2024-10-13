<?php

namespace app\Data;

use PDO;
use app\Models\Rol;
use app\Interfaces\RolInterface;
use app\Data\BaseData;

class RolData extends BaseData implements RolInterface
{
    const TABLE = 'rol';

    public function get(): array {
        $sql = "SELECT * FROM " . self::TABLE;
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roles = [];
        foreach ($rows as $row) {
            $roles[] = new Rol($row['id'], $row['nombre']);
        }

        return $roles;
    }

    public function create(Rol $rol): bool
    {
        $sql = "INSERT INTO " . self::TABLE . " (nombre) VALUES (:nombre)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nombre' => $rol->getNombre()]);
        return true;
    }

    public function update(Rol $rol): bool
    {
        $sql = "UPDATE " . self::TABLE . " SET nombre = :nombre WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nombre' => $rol->getNombre(), 'id' => $rol->getId()]);
        return true;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM " . self::TABLE . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function exists(int $id): bool
    {
        $sql = "SELECT COUNT(*) FROM " . self::TABLE . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getById(int $id): ?Rol
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Rol($row['id'], $row['nombre']) : null;
    }
}