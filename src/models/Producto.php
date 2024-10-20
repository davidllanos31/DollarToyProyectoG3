<?php

namespace app\Models;

class Producto
{
    private int $id_producto;
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private string $imagen_url;
    private int $id_categoria_producto;

    public function __construct(
        int $id_producto,
        string $nombre,
        string $descripcion,
        float $precio,
        string $imagen_url,
        int $id_categoria_producto,
    ) {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->imagen_url = $imagen_url;
        $this->id_categoria_producto = $id_categoria_producto;
    }

    public function getId()
    {
        return $this->id_producto;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getImg()
    {
        return $this->imagen_url;
    }
    public function getCategoria()
    {
        return $this->id_categoria_producto;
    }

    public function setId($id)
    {
        $this->id_producto = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setImg($img)
    {
        $this->imagen_url = $img;
    }
    public function setCategoria($id_categoria_producto)
    {
        $this->id_categoria_producto = $id_categoria_producto;
    }
}
