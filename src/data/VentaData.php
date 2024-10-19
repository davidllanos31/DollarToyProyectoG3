<?php

namespace app\Data;

use PDO;
use app\Data\BaseData;
use app\Models\Venta;
use app\Interfaces\VentaInterface;

class VentaData extends BaseData implements VentaInterface
{
    const TABLE = 'tb_ventas';

    public function get(): array
    {
        try {
            $sql = "CALL sp_ListarVentas()";
            $stmt = $this->pdo->query($sql);
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ventas = [];
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
        } catch (\Exception $e) {
            // Manejo de errores, puedes registrar el error o lanzar una excepción personalizada
            error_log("Error al obtener las ventas: " . $e->getMessage());
            return [];
        }
    }

    public function create(Venta $venta): bool
    {
        try {
            $sql = "INSERT INTO " . self::TABLE . " (nombre_cliente, nombre_vendedor, nombre_producto, cantidad, fecha_venta, metodo_pago, total)
                    VALUES (:nombre_cliente, :nombre_vendedor, :nombre_producto, :cantidad, :fecha_venta, :metodo_pago, :total)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nombre_cliente', $venta->nombre_cliente);
            $stmt->bindParam(':nombre_vendedor', $venta->nombre_vendedor);
            $stmt->bindParam(':nombre_producto', $venta->nombre_producto);
            $stmt->bindParam(':cantidad', $venta->cantidad);
            $stmt->bindParam(':fecha_venta', $venta->fecha_venta);
            $stmt->bindParam(':metodo_pago', $venta->metodo_pago);
            $stmt->bindParam(':total', $venta->total);

            return $stmt->execute();
        } catch (\Exception $e) {
            error_log("Error al crear la venta: " . $e->getMessage());
            return false;
        }
    }

    public function update(Venta $venta): bool
    {
        // Implementación de la lógica de actualización
        return true;
    }

    public function delete(int $id): bool
    {
        // Implementación de la lógica de eliminación
        return true;
    }

    public function getById(int $id): ?Venta
    {
        try {
            $sql = "SELECT nombre_cliente, nombre_vendedor, nombre_producto, cantidad, fecha_venta, metodo_pago, total
                    FROM " . self::TABLE . " WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($fila) {
                return new Venta(
                    $fila['nombre_cliente'],
                    $fila['nombre_vendedor'],
                    $fila['nombre_producto'],
                    (int)$fila['cantidad'],
                    $fila['fecha_venta'],
                    $fila['metodo_pago'],
                    (float)$fila['total']
                );
            } else {
                return null;
            }
        } catch (\Exception $e) {
            error_log("Error al obtener la venta por ID: " . $e->getMessage());
            return null;
        }
    }
}
