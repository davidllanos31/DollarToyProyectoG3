<?php

namespace app\Data;

use PDO;
use app\Models\Categoria;
use app\Interfaces\CategoriaInterface;
use app\Data\BaseData;

class CategoriaData extends BaseData implements CategoriaInterface
{
    const TABLE = 'tb_categoria';

    public function find(array $filters): array
    {
        $sql = "CALL sp_listar_categoria(?, ?)";
        $stmt = $this->pdo->prepare($sql);
        
        $id = $filters['id'] ?? null;
        $nombre = $filters['nombre'] ?? null;
        
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categorias = [];
        foreach ($result as $row) { 
            $categorias[] = new Categoria($row['id_categoria'], $row['nombre'], $row['descripcion']);
        }
        
        return $categorias;
    }
    
    public function save(Categoria $categoria): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function exists(int $id): bool
    {
        return true;
    }
}