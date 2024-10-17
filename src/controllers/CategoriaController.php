<?php

namespace app\Controllers;

use app\Business\CategoriaBusiness\CategoriaDelete;
use app\Models\Categoria;
use app\Business\CategoriaBusiness\CategoriaGet;
use app\Data\CategoriaData;
use app\Validators\CategoriaValidator;
use app\Exceptions\DataException;
use app\Exceptions\ValidationException;
use app\Factories\CategoryFactory;

class CategoriaController
{
    private $validator;
    private $repository;

    public function __construct()
    {
        $this->validator = new CategoriaValidator();
        $this->repository = new CategoriaData();
    }

    public function index()
    {
        $getCategoria = new CategoriaGet($this->repository, $this->validator);
        $categorias = $getCategoria->find(['id_categoria' => null, 'nombre' => null]);
        $title = 'Lista de Categorias';
        $content = __DIR__ . '/../views/pages/categorias/index.php';
        include __DIR__ . '/../views/layouts/main.php';
    }

    public function create()
    {
        require_once 'views/categoria/create.php';
    }

    public function buscar()
    {
        $query = $_POST['query'];

        $categorias = $this->repository->find(['id_categoria' => null, 'nombre' => $query]);

        $categoriasArray = array_map(function($categoria) {
            return [
                'id' => $categoria->getId(),
                'nombre' => $categoria->getNombre(),
                'descripcion' => $categoria->getDescripcion()
            ];
        }, $categorias);
    
        echo json_encode($categoriasArray);
        
    }

    public function store()
    {
        $body = $_POST;
        // $addCategoria = new CategoriaAdd($this->repository, $this->validator);

        try {
            $categoria = CategoryFactory::create(null, $body['nombre'], $body['descripcion']);
            // $addCategoria->add($categoria);
            header('Location: /categorias');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        // $getCategoria = new CategoriaGet($this->repository, $this->validator);
        // $categoria = $getCategoria->find(['id_categoria' => $id]);
    }

    public function update($id)
    {
        $body = $_POST;
        // $updateCategoria = new CategoriaUpdate($this->repository, $this->validator);

        try {
            $categoria = CategoryFactory::create($id, $body['nombre'], $body['descripcion']);
            // $updateCategoria->updateById($id, $categoria);
            header('Location: /categorias');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        $deleteCategoria = new CategoriaDelete($this->repository);
        $deleteCategoria->deleteById($id);
        header('Location: /categorias');
    }
}
