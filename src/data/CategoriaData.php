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
    
    public function create(Categoria $categoria): bool
    {
        $sql = "CALL sp_guardar_categoria(?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $id = $categoria->getId();
        $nombre = $categoria->getNombre();
        $descipcion = $categoria->getDescripcion();


        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(3, $descipcion, PDO::PARAM_STR);


        $stmt->execute();

        return true;
    }

    public function delete(int $id): bool
    {
        $sql = "delete from tb_categoria where id_categoria = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function exists(int $id): bool
    {
        return true;
    }
}