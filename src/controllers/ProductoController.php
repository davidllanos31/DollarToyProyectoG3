<?php

namespace app\controllers;

use app\Business\Producto\ProductoAdd;
use app\Business\ProductosBusiness\ProductoGet;
use app\Business\Producto\ProductoUpdate;
use app\Business\Producto\ProductoDelete;
use app\Data\CategoriaRepository;
use app\Data\ProductoData;
use app\Data\ProductoRepository;
use app\Data\SedeRepository;
use app\Validators\ProductoValidator;

class ProductoController
{
    private $validator;
    private $repository;
    private $categoriaRepository;
    private $sedeRepository;

    public function __construct()
    {
        $this->validator = new ProductoValidator();
        $this->repository = new ProductoData();

        // $this->sedeRepository = new SedeRepository();
    }

    public function index()
    {
        $getProducto = new ProductoGet($this->repository, $this->validator);
        $productos = $getProducto->find(['id_producto' => null, 'nombre' => null, 'id_categoria_producto' => null, 'id_sede' => null, 'precio_min' => null, 'precio_max' => null]);
        $title = 'Lista de Productos';
        // var_dump($productos);
        require_once __DIR__ . '/../views/pages/productos/index.php';
    }

    public function buscar()
    {
        $query = $_GET['query'];

        $productos = $this->repository->find(['id_producto' => null, 'nombre' => $query]);

        $productosArray = array_map(function ($producto) {
            return [
                'id' => $producto->getId(),
                'nombre' => $producto->getNombre(),
                'descripcion' => $producto->getDescripcion(),
                'precio' => $producto->getPrecio(),
                'imagen_url' => $producto->getImg(),
                // 'sede' => $producto->getSede()->getNombre()
            ];
        }, $productos);

        echo json_encode($productosArray);
    }

    public function nuevoProducto()
    {
        $title = 'Nuevo Producto';
        $content = __DIR__ . '/../views/pages/productos/create.php';
        if ($this->isAjaxRequest()) {
            include $content;
        } else {
            include __DIR__ . '/../views/layouts/main.php';
        }
    }

    public function store()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Procesar el formulario
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $id_categoria_producto = $_POST['id_categoria_producto'];
                $id_sede = $_POST['id_sede'];
                $img = $_FILES['img']['name']; // Obtener la imagen del formulario

                // Mover la imagen a la carpeta correspondiente
                move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/../uploads/' . $img);

                // Agregar el producto
                $addProducto = new ProductoAdd($this->repository, $this->validator);
                $addProducto->add($nombre, $descripcion, $precio, $id_categoria_producto, $id_sede, $img);

                // Devolver respuesta de éxito
                echo json_encode(['message' => 'Producto guardado con éxito']);
            } else {
                // Obtener las categorías y sedes para el formulario
                $categorias = $this->categoriaRepository->find(['id_categoria' => null, 'nombre' => null]);
                $sedes = $this->sedeRepository->find(['id_sede' => null, 'nombre' => null]);
                require_once __DIR__ . '/../views/pages/productos/create.php';
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../views/pages/productos/create.php';
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $producto = $this->repository->find(['id_producto' => $id, 'nombre => null']);
        $categorias = $this->categoriaRepository->find(['id_categoria' => null, 'nombre' => null]);
        $sedes = $this->sedeRepository->find(['id_sede' => null, 'nombre' => null]);
        require_once __DIR__ . '/../views/pages/productos/edit.php';
    }

    public function delete ()
    {
        $id = $_GET['id'];
        $deleteProducto = new ProductoDelete($this->repository, $this->validator);
        $deleteProducto->delete($id);
        header('Location: /productos');
    }

    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
