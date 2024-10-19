<?php

namespace app\Models;

class Usuario
{
    private int $id;
    private string $nombre;
    private string $apellido;
    private string $email;
    private string $celular;
    private string $fechaRegistro;
    private string $rol;

    public function __construct(
        int $id,
        string $nombre,
        string $apellido,
        string $email,
        string $celular,
        string $fechaRegistro,
        string $rol
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->celular = $celular;
        $this->fechaRegistro = $fechaRegistro;
        $this->rol = $rol;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getCelular(): string
    {
        return $this->celular;
    }

    public function getFechaRegistro(): string
    {
        return $this->fechaRegistro;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setCelular(string $celular): void
    {
        $this->celular = $celular;
    }

    public function setFechaRegistro(string $fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }
}
