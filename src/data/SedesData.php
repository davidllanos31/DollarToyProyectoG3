<?php

namespace app\Data;

use PDO;
use app\Models\Sedes;
use app\Interfaces\SedesInterface;
use app\Data\BaseData;

class SedesData extends BaseData implements SedesInterface
{
    const TABLE = 'tb_sedes';

    public function find(array $filters): array
    {
        $sql = "CALL sp_listar_sede (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        
        $id = $filters['id'] ?? null;
        $nombre = $filters['nombre'] ?? null;
        
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
        $sedes = [];
        foreach ($result as $row) { 
            $sedes[] = new Sedes($row['id_sede'], $row['nombre'], $row['direccion'], $row['ciudad']);
        }
        return $sedes;
    }
    
    public function save(Sedes $sede): bool
    {
        // $sql = "CALL sp_guardar_sede(?, ?, ?, ?, ?)";
        // $stmt = $this->pdo->prepare($sql);
        
        // $nombre = $sede->getNombre();
        // $direccion = $sede->getDireccion();
        // $telefono = $sede->getTelefono();
        // $id_ciudad = $sede->getIdCiudad();
        
        // $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        // $stmt->bindParam(2, $direccion, PDO::PARAM_STR);
        // $stmt->bindParam(3, $telefono, PDO::PARAM_STR);
        // $stmt->bindParam(4, $id_ciudad, PDO::PARAM_INT);
        // $stmt->bindParam(5, $id, PDO::PARAM_INT);
        
        // $stmt->execute();
        
        return true;
    }

    public function delete(int $id): bool
    {
        // $sql = "CALL sp_eliminar_sede(?)";
        // $stmt = $this->pdo->prepare($sql);
        
        // $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        // $stmt->execute();
        
        return true;
    }

    public function exists(int $id): bool
    {
        // $sql = "CALL sp_existe_sede(?)";
        // $stmt = $this->pdo->prepare($sql);
        return true;
    }

}