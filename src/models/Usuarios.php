<?php

namespace app\Models;

class Usuario
{
    private string $id_usuario;
    private string $nombre;
    private string $apellido;
    private string $email;
    private int $celular;
    private string $contraseña; // Considera encriptar esta propiedad
    private string $fecha_registro;
    private string $id_usuario_rol;

    public function __construct(
        string $id_usuario,
        string $nombre,
        string $apellido,
        string $email,
        int $celular,
        string $contraseña,
        string $fecha_registro,
        string $id_usuario_rol
    ) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->celular = $celular;
        $this->contraseña = $contraseña;
        $this->fecha_registro = $fecha_registro;
        $this->id_usuario_rol = $id_usuario_rol;
    }

    // Métodos getters
    public function getIdUsuario(): string
    {
        return $this->id_usuario;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getApellido(): string
    {
        return $this->apellido;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getCelular(): int
    {
        return $this->celular;
    }
    public function getContraseña(): string
    {
        return $this->contraseña;
    }
    public function getFechaRegistro(): string
    {
        return $this->fecha_registro;
    }
    public function getIdUsuarioRol(): string
    {
        return $this->id_usuario_rol;
    }
}
