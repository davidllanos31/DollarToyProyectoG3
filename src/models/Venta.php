<?php
namespace app\Models;
class VentaModel
{   
    public string $codigo;
    public string $nombre;

    public function __construct(?string $id, string $nombre)
    {
        $this->codigo = $id;
        $this->nombre = $nombre;
    }
}