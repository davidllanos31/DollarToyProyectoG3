<?php

namespace app\Controllers;

use app\Models\Rol;
use app\Business\RolBusiness\AddRol;
use app\Business\RolBusiness\GetRol;
use app\Business\RolBusiness\UpdateRol;
use app\Business\RolBusiness\DeleteRol;
use app\Data\RolData;
use app\Validators\RolValidator;
use app\Exceptions\DataException;
use app\Exceptions\ValidationException;
use app\Factories\RolFactory;

class RolController
{
    private $validator;
    private $repository;

    public function __construct()
    {
        $this->validator = new RolValidator();
        $this->repository = new RolData();
    }

    public function index()
    {
        $getRol = new GetRol($this->repository); 
        $roles = $getRol->get();

        $title = 'Lista de Roles';
        include __DIR__ . '/../views/pages/roles/index.php';
    }

    public function create()
    {
        $title = 'Crear Role';
        $content = __DIR__ . '/../views/pages/roles/create.php';
        include __DIR__ . '/../views/layouts/main.php';
    }

    public function store()
    {
        $body = $_POST;
        $addRol = new AddRol($this->repository, $this->validator);

        try {
            $rol = RolFactory::create(null, $body['nombre']);
            $addRol->add($rol);
            header('Location: /roles');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $getRol = new GetRol($this->repository);
        $rol = $getRol->getById($id);

        $title = 'Editar Role';
        $content = __DIR__ . '/../views/pages/roles/edit.php';
        include __DIR__ . '/../views/layouts/main.php';
    }
    
    public function update($id)
    {
        $body = $_POST;
        $updateRol = new UpdateRol($this->repository, $this->validator);

        try {
            $rol = RolFactory::create($id, $body['nombre']);
            $updateRol->update($rol);
            header('Location: /roles');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        $deleteRol = new DeleteRol($this->repository);
        $deleteRol->delete($id);
        header('Location: /roles');
    }
}