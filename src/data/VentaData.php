<?php
namespace app\Data;

use PDO;
use app\Data\BaseData;
use app\Models\Venta;
use app\Interfaces\VentaInterface;

class VentaData extends BaseData implements VentaInterface
{   
    const TABLE = 'tb_ventas';


    public function get(): array{
        $sql = "CALL sp_ListarVentas()";
        $stmt = $this->pdo->query($sql);
        $filas =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ventas=[];
        foreach ($filas as $fila) {
            $ventas[] = new Venta(
                $fila['nombre_cliente'],   
                $fila['nombre_vendedor'],  
                $fila['nombre_producto'],  
                (int)$fila['cantidad'],    
                $fila['fecha_venta'],      
                $fila['metodo_pago'],      
                (float)$fila['total']      
            );
        }
        return $ventas;
    }
    public function create (Venta $venta): bool{
        return true;

    }

    public function update(Venta $venta): bool{
        return true;
    }
    public function delete(int $id): bool{
        return true;
    }
    public function getById(int $id): ?Venta{
        $fila= new Venta([]);
        return $fila;
    } 
}