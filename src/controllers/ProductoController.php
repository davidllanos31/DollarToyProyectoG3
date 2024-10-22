<?php

namespace app\controllers;

use app\Business\ProductosBusiness\ProductoAdd;
use app\Business\ProductosBusiness\ProductoGet;
use app\Data\CategoriaData;
use app\Data\ProductoData;
use app\Data\SedesData;
use app\exceptions\DataException;
use app\exceptions\ValidationException;
use app\Models\Producto;
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
        $this->categoriaRepository = new CategoriaData();
        $this->sedeRepository = new SedesData();
        // $this->sedeRepository = new SedeRepository();
    }

    public function index()
    {
        $getProducto = new ProductoGet($this->repository, $this->validator);
        $productos = $getProducto->find(['id_producto' => null, 'nombre' => null, 'id_categoria_producto' => null, 'id_sede' => null, 'precio_min' => null, 'precio_max' => null]);
        $title = 'Lista de Productos';
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
        $categorias = $this->categoriaRepository->find(['id_categoria' => null, 'nombre' => null]);
        $sedes = $this->sedeRepository->find(['id_sede' => null, 'nombre' => null]);
        
        $categorias = array_map(function ($categoria) {
            return [
                'id' => $categoria->getId(),
                'nombre' => $categoria->getNombre(),
                'descripcion' => $categoria->getDescripcion()
            ];
        }, $categorias);

        $sedes = array_map(function ($sede) {
            return [
                'id' => $sede->getId(),
                'nombre' => $sede->getNombre(),
                'direccion' => $sede->getDireccion(),
                'ciudad' => $sede->getCiudad()
            ];
        }, $sedes);

        // var_dump($sedes);
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
        $body = $_POST;
        $body['id_categoria'] = (int)$_POST['id_categoria_producto'];
        $img = $_POST['img'] ?? null;
        //guardar el nombre del archivo de la imagen con el filename
        $body['imagen_url'] = $img['name'] ?? 'imagen.jpg';
        // var_dump($body);
        try {
        //     private int $id_producto,
        // private string $nombre,
        // private string $descripcion,
        // private float $precio,
        // private string $imagen_url,
        // private int $id_categoria_producto,

            $addProducto = new ProductoAdd($this->repository, $this->validator, $this->categoriaRepository, $this->sedeRepository);

            $addProducto->add($body);
            $res = json_encode(['status' => 'success', 'message' => 'Producto agregado correctamente']);
            echo $res;
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function edit()
    {
        $categorias = $this->categoriaRepository->find(['id_categoria' => null, 'nombre' => null]);
        $sedes = $this->sedeRepository->find(['id_sede' => null, 'nombre' => null]);
        $id = $_POST['id'];
        $productos = $this->repository->find(['id_producto' => $id, 'nombre => null']);
        $categorias = array_map(function ($categoria) {
            return [
                'id' => $categoria->getId(),
                'nombre' => $categoria->getNombre(),
                'descripcion' => $categoria->getDescripcion()
            ];
        }, $categorias);

        $sedes = array_map(function ($sede) {
            return [
                'id' => $sede->getId(),
                'nombre' => $sede->getNombre(),
                'direccion' => $sede->getDireccion(),
                'ciudad' => $sede->getCiudad()
            ];
        }, $sedes);

        $content = __DIR__ . '/../views/pages/productos/edit.php';
        if ($this->isAjaxRequest()) {
            include $content;
        } else {
            include __DIR__ . '/../views/layouts/main.php';
        }
    }

    public function delete()
    {
        // $id = $_GET['id'];
        // $deleteProducto = new ProductoDelete($this->repository, $this->validator);
        // $deleteProducto->delete($id);
        // header('Location: /productos');
    }

    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
