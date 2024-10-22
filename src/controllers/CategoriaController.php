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
        // echo var_dump($categorias);
        // die();
        require_once __DIR__ . '/../views/pages/categorias/index.php';
    }

    public function create()
    {
        require_once 'views/categoria/create.php';
    }

    public function buscar()
    {
        $query = $_POST['query'];

        $categorias = $this->repository->find(['id_categoria' => null, 'nombre' => $query]);

        $categoriasArray = array_map(function ($categoria) {
            return [
                'id' => $categoria->getId(),
                'nombre' => $categoria->getNombre(),
                'descripcion' => $categoria->getDescripcion()
            ];
        }, $categorias);

        echo json_encode($categoriasArray);
    }

    public function nuevaCategoria()
    {
        $title = 'Nueva Sede';
        $content = __DIR__ . '/../views/pages/categorias/create.php';
        if ($this->isAjaxRequest()) {
            include $content;
        } else {
            include __DIR__ . '/../views/layouts/main.php';
        }
    }

    public function store()
    {
        try {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria = new Categoria(0,$nombre, $descripcion);
            $registrar_categoria = $this->repository->create($categoria);
            if ($registrar_categoria) {
                echo json_encode(['status' => 'success', 'message' => 'Categoria creada correctamente']);
            }
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar sede' . $e->getMessage()]);
        } 
    }

    public function edit()
    {
        try {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria = new Categoria($id,$nombre, $descripcion);
            $registrar_categoria = $this->repository->create($categoria);
            if ($registrar_categoria) {
                echo json_encode(['status' => 'success', 'message' => 'Categoria editada correctamente']);
            }
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar sede' . $e->getMessage()]);
        } 
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

    public function delete()
    {
        $id = $_GET['id'];
        try {
            $deleted = $this->repository->delete($id);
    
            if ($deleted) {
                // Si la eliminación fue exitosa, redirigir o devolver un mensaje de éxito
                header('Location: /categorias?message=Categoría eliminada correctamente');
            } else {
                // Si no se pudo eliminar, manejar el error
                echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar la categoría']);
            }
        } catch (DataException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la categoría: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()]);
        }
    }
    
    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
