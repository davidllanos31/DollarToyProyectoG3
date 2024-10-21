<?php

namespace app\Data;

use PDO;
use app\Data\BaseData;

class HomeData extends BaseData
{

    public function getGraficosData()
    {
        try {
            $sql = "CALL sp_obtener_cantidad_ventas_por_mes()";
            $cantidadVentasStmt = $this->pdo->prepare($sql);
            $cantidadVentasStmt->execute();
            $datos = $cantidadVentasStmt->fetchAll(PDO::FETCH_ASSOC);
            $ventasPorMes = array_fill(0, 12, 0); // 12 meses
            $ingresosPorMes = array_fill(0, 12, 0); // 12 meses

            // Asigna los datos recuperados a los arrays correspondientes
            foreach ($datos as $dato) {
                $mesIndex = (int)date('n', strtotime($dato['mes'])) - 1; // Obtiene el índice del mes
                $ventasPorMes[$mesIndex] = $dato['cantidad_ventas'];
                $ingresosPorMes[$mesIndex] = $dato['ingresos_totales'];
            }

            // Convierte los arrays a formato JSON para su uso en JavaScript
            $ventasPorMesJSON = json_encode($ventasPorMes);
            $ingresosPorMesJSON = json_encode($ingresosPorMes);
            return [
                'cantidad_ventas' => $ventasPorMesJSON,
                'suma_totales' => $ingresosPorMesJSON,
            ];
        } catch (\Exception $e) {
            // Manejo de errores, puedes registrar el error o lanzar una excepción personalizada
            error_log("Error al obtener las datos de gráifcos: " . $e->getMessage());
            throw $e;
        }
    }
}
