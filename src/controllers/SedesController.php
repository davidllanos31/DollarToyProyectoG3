<?php

namespace app\Controllers;

use app\Business\SedesBusiness\SedesDelete;
use app\Models\Sedes;
use app\Business\SedesBusiness\SedesGet;
use app\Data\SedesData;
use app\Validators\SedesValidator;
use app\Exceptions\DataException;
use app\Exceptions\ValidationException;
use app\Factories\SedesFactory;

class SedesController
{
    private $validator;
    private $repository;

    public function __construct()
    {
        $this->validator = new SedesValidator();
        $this->repository = new SedesData();
    }

    public function index()
    {
        $getSedes = new SedesGet($this->repository, $this->validator);
        $sedes = $getSedes->find(['id_sede' => null, 'nombre' => null]);
        $title = 'Lista de Sedes';
        require_once __DIR__ . '/../views/pages/sedes/index.php';
    }

    public function create()
    {
        require_once 'views/sedes/create.php';
    }

    public function buscar()
    {
        $query = $_POST['query'];

        $sedes = $this->repository->find(['id_sede' => null, 'nombre' => $query]);

        $sedesArray = array_map(function($sede) {
            return [
                'id' => $sede->getId(),
                'nombre' => $sede->getNombre(),
                'direccion' => $sede->getDireccion(),
                'ciudad' => $sede->getCiudad()
            ];
        }, $sedes);
    
        echo json_encode($sedesArray);
        
    }

    public function store()
    {
        $body = $_POST;
        // $addSedes = new SedesAdd($this->repository, $this->validator);
        try {

            $sedes = SedesFactory::create(null , $body['nombre'], $body['direccion'], $body['ciudad']);
            header('Location: /sedes');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        // $id = $_GET['id'];

        // $sede = $this->repository->find(['id_sede' => $id]);

        // require_once 'views/sedes/edit.php';
    }

    public function update()
    {
        // $body = $_POST;

        // $sede = SedesFactory::create($body);

        // $this->validator->validate($sede);

        // $this->repository->update($sede);

        // header('Location: /sedes');
    }

    public function delete()
    {
        // $id = $_GET['id'];

        // $deleteSede = new SedesDelete($this->repository, $this->validator);
        // $deleteSede->delete($id);

        // header('Location: /sedes');
    }
}
