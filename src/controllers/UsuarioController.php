<?php

namespace app\Controllers;

use app\Business\UsuarioBusiness\UsuarioDelete;
use app\Models\Usuario;
use app\Business\UsuarioBusiness\UsuarioGet;
use app\Data\UsuarioData;
use app\Validators\UsuarioValidator;
use app\Exceptions\DataException;
use app\Exceptions\ValidationException;
use app\Factories\UserFactory;

class UsuarioController
{
    private $validator;
    private $repository;

    public function __construct()
    {
        $this->validator = new UsuarioValidator();
        $this->repository = new UsuarioData();
    }

    public function index()
    {
        $getUsuario = new UsuarioGet($this->repository, $this->validator);
        $usuarios = $getUsuario->find(['id' => null, 'nombre' => null, 'apellido' => null, 'email' => null, 'id_rol' => null]);
        $title = 'Lista de Usuarios';
        require_once __DIR__ . '/../views/pages/usuarios/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/pages/usuarios/index.php';
    }

    public function buscar()
    {
        $query = $_POST['query'];
        $usuarios = $this->repository->find(['id_rol' => $query]);

        $usuariosArray = array_map(function ($usuario) {
            return [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'apellido' => $usuario->getApellido(),
                'email' => $usuario->getEmail(),
                'celular' => $usuario->getCelular(),
                'fecha_registro' => $usuario->getFechaRegistro(),
                'rol' => $usuario->getRol()
            ];
        }, $usuarios);

        echo json_encode($usuariosArray);
    }

    public function store()
    {
        $body = $_POST;

        try {
            $usuario = new Usuario(
                0,
                $body['nombre'],
                $body['apellido'],
                $body['email'],
                $body['celular'],
                $body['contraseña'],
                $body['id_usuario_rol']
            );
            $nuevousuario = $this->repository->save($usuario);
            header('Location: /DollarToyProyectoG3/usuarios');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        // $getUsuario = new UsuarioGet($this->repository, $this->validator);
        // $usuario = $getUsuario->find(['id_usuario' => $id]);
    }

    public function update($id)
    {
        $body = $_POST;

        try {
            $usuario = UserFactory::create(
                $id,
                $body['nombre'],
                $body['apellido'],
                $body['email'],
                $body['celular'],
                $body['contraseña'],
                $body['id_usuario_rol']
            );
            header('Location: /usuarios');
        } catch (ValidationException $e) {
            echo $e->getMessage();
        } catch (DataException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        $deleteUsuario = new UsuarioDelete($id, $this->validator);
        $deleteUsuario->deleteById($id);
        header('Location: /DollarToyProyectoG3/usuarios');
    }
}
