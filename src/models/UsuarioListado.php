<?php

namespace app\Models;

class UsuarioListado
{
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $celular;
    public $rol;

    public function __construct($id_usuario, $nombre, $apellido, $email, $celular, $rol)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->celular = $celular;
        $this->rol = $rol;
    }


    public function getId()
    {
        return $this->id_usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function getRol()
    {
        return $this->rol;
    }
}
