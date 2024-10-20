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
        $query = "CALL sp_listar_sede(?, ?)";
        $stmt = $this->pdo->prepare($query);

        $id = $filters['id'] ?? null;
        $nombre = $filters['nombre'] ?? null;

        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);

        $stmt->execute();

        $sedes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sedesArray = [];
        foreach ($sedes as $sede) {
            $sedesArray[] = new Sedes($sede['id_sede'], $sede['nombre'], $sede['direccion'], $sede['ciudad']);
        }

        return $sedesArray;
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