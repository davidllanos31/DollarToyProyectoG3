<?php

namespace app\Data;

use app\Interfaces\ProductoInterface;
use PDO;
use app\Interfaces\RolInterface;
use app\Models\Producto;
use app\Models\SedeProducto;

class ProductoData extends BaseData implements ProductoInterface
{
    const TABLE = 'tb_producto';

    public function find(array $filters): array
    {
        $sql = "CALL sp_listar_producto(?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        $id = $filters['id'] ?? null;
        $nombre = $filters['nombre'] ?? null;
        $id_categoria_producto = $filters['id_categoria_producto'] ?? null;
        $id_sede = $filters['id_sede'] ?? null;
        $precio_min = $filters['precio_min'] ?? null;
        $precio_max = $filters['precio_max'] ?? null;

        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(3, $id_categoria_producto, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_sede, PDO::PARAM_INT);
        $stmt->bindParam(5, $precio_min, PDO::PARAM_STR);
        $stmt->bindParam(6, $precio_max, PDO::PARAM_STR);

        $stmt->execute();

        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $productos = [];
        foreach ($result as $row) {
            $productos[] = new Producto($row['id_producto'], $row['nombre'], $row['descripcion'], $row['precio'], $row['imagen_url'], $row['id_categoria_producto']);
        }

        return $productos;
    }

    public function create(Producto $producto, SedeProducto $sedeproducto): bool
    {
        try {
            // Obtener categorías y sedes desde sus respectivos repositorios
            $categorias = $this->categoriaRepository->findAll(); // Método para obtener todas las categorías
            $sedes = $this->sedeRepository->findAll();           // Método para obtener todas las sedes
            
            // Pasar las categorías y sedes a la vista
            require_once __DIR__ . '/../views/pages/productos/create.php';
        } catch (\Exception $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../views/pages/error.php';
        }
        
        $sql = "CALL sp_guardar_producto(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        $id = $producto->getId();
        $nombre = $producto->getNombre();
        $descripcion = $producto->getDescripcion();
        $precio = $producto->getPrecio();
        $img = $producto->getImg(); // Asegúrate de tener el getter para la imagen
        $id_categoria_producto = $producto->getIdCategoriaProducto(); // Getter para la categoría
        $id_sede = $sedeproducto->getId_sede();
        $stock_disponible = $sedeproducto->getStock_disponible();

        // Asignamos los parámetros del producto
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(3, $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(4, $precio, PDO::PARAM_STR);
        $stmt->bindParam(5, $img, PDO::PARAM_STR);  // Imagen
        $stmt->bindParam(6, $id_categoria_producto, PDO::PARAM_INT);  // Categoría
        $stmt->bindParam(7, $id_sede, PDO::PARAM_INT);
        $stmt->bindParam(8, $stock_disponible, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }


    public function delete(int $id): bool
    {
        $sql = "CALL sp_eliminar_producto(?)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }

    public function exists(int $id): bool
    {
        $sql = "CALL sp_existe_producto(?)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['existe'] == 1;
    }
}
