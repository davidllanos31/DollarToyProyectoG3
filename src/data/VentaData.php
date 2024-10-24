<?php

namespace app\Data;

use PDO;
use app\Data\BaseData;
use app\Models\Venta;
use app\Interfaces\VentaInterface;
use app\Models\VentaListado;

class VentaData extends BaseData implements VentaInterface
{
    const TABLE = 'tb_ventas';

    public function get(array $filters): array
    {
        try {
            $sql = "CALL sp_listar_venta(?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $id = $filters['id'] ?? null;
            $id_usuario = $filters['id_usuario'] ?? null;
            $cliente = $filters['cliente'] ?? null;
            $fecha_venta = $filters['fecha_venta'] ?? null;
            $id_metodo_pago = $filters['id_metodo_pago'] ?? null;
            $total_min  = $filters['total_min'] ?? null;
            $total_max = $filters['total_max'] ?? null;

            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(3, $cliente, PDO::PARAM_STR);
            $stmt->bindParam(4, $fecha_venta, PDO::PARAM_STR);
            $stmt->bindParam(5, $id_metodo_pago, PDO::PARAM_STR);
            $stmt->bindParam(6, $total_min, PDO::PARAM_STR);
            $stmt->bindParam(7, $total_max, PDO::PARAM_STR);
            $stmt->execute();


            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ventas = [];
            foreach ($filas as $fila) {
                $ventas[] = new VentaListado(
                    $fila['id_venta'],
                    $fila['nombre_usuario'],
                    $fila['cliente'],
                    $fila['fecha_venta'],
                    $fila['nombre_metodopago'],
                    (float)$fila['total']
                );
            }
            if (empty($filas)) {
                return [];
            }
            return $ventas;
        } catch (\Exception $e) {
            // Manejo de errores, puedes registrar el error o lanzar una excepción personalizada
            error_log("Error al obtener las ventas: " . $e->getMessage());
            throw $e;
        }
    }

    public function create(Venta $venta): bool
    {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare('CALL sp_guardar_venta(?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                0, //0 indica al procedimiento que debe crear
                $venta->id_usuario,
                $venta->cliente,
                $venta->fecha_venta,
                $venta->id_metodopago,
                $venta->total,
            ]);
            $stmt = $this->pdo->query('SELECT LAST_INSERT_ID()'); //id de la venta recién insertada
            $id_venta = $stmt->fetchColumn();
            if (!$id_venta) {
                throw new \Exception("No se pudo obtener el ID de la venta.");
            }
            foreach ($venta->detalles as $detalle) {
                $stmDetalle = $this->pdo->prepare('CALL sp_guardar_detalle_venta(?, ?, ?, ?, ?)');
                $stmDetalle->execute([
                    0, // para crear
                    $id_venta,
                    $detalle->id_producto,
                    $detalle->cantidad,
                    $detalle->precio_unitario
                ]);
            }
            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log("Error al crear la venta: " . $e->getMessage());
            throw $e;
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
