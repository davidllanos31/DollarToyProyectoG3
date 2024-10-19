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

    public function create()
    {
        $categorias = $this->categoriaRepository->find(['id_categoria' => null, 'nombre' => null]);
        $sedes = $this->sedeRepository->find(['id_sede' => null, 'nombre' => null]);
        require_once __DIR__ . '/../views/pages/productos/create.php';
    }

    public function buscar()
    {
        $query = $_POST['query'];

        $productos = $this->repository->find(['id_producto' => null, 'nombre' => $query]);

        $productosArray = array_map(function($producto) {
            return [
                'id' => $producto->getId(),
                'nombre' => $producto->getNombre(),
                'descripcion' => $producto->getDescripcion(),
                'precio' => $producto->getPrecio(),
                'categoria' => $producto->getCategoria()->getNombre(),
                'sede' => $producto->getSede()->getNombre()
            ];
        }, $productos);
    
        echo json_encode($productosArray);
        
    }

    // public function store()
    // {
    //     $body = $_POST;
    //     $producto = $this->repository->save($body);
    //     $sedeproducto = $this->sedeRepository->save($body);
    //     $addProducto = new ProductoAdd($this->repository, $this->validator);
    //     $addProducto->add($producto, $sedeproducto);
    //     header('Location: /productos');
    // }

    public function edit()
    {
        $id = $_GET['id'];
        $producto = $this->repository->find(['id_producto' => $id, 'nombre => null']);    
        $categorias = $this->categoriaRepository->find(['id_categoria' => null, 'nombre' => null]);
        $sedes = $this->sedeRepository->find(['id_sede' => null, 'nombre' => null]);
        require_once __DIR__ . '/../views/pages/productos/edit.php';
    }
}
