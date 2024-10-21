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

    public function nuevaSede()
    {
        $title = 'Nueva Sede';
        $content = __DIR__ . '/../views/pages/sedes/create.php';
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
            $direccion = $_POST['direccion'];
            $ciudad = $_POST['ciudad'];
            $sede = new Sedes(0,$nombre, $direccion, $ciudad);
            $registar_sede = $this->repository->create($sede);
            if ($registar_sede) {
                echo json_encode(['status' => 'success', 'message' => 'Sede registrada correctamente']);
            }
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar sede' . $e->getMessage()]);
        } 
        
    }
    public function self()
    {
        // $body = $_POST;
        // // $addSedes = new SedesAdd($this->repository, $this->validator);
        // try {

        //     $sedes = SedesFactory::create(null , $body['nombre'], $body['direccion'], $body['ciudad']);
        //     header('Location: /sedes');
        // } catch (ValidationException $e) {
        //     echo $e->getMessage();
        // } catch (DataException $e) {
        //     echo $e->getMessage();
        // }
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
    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
