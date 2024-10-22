<?php

namespace app\Business\ProductosBusiness;

use app\exceptions\DataException;
use app\Interfaces\CategoriaInterface;
use app\Interfaces\ProductoInterface;
use app\Interfaces\SedesInterface;
use app\Exceptions\ValidationException;
use app\interfaces\ValidatorInterfaceActual;
use app\Models\Producto;
use app\Models\SedeProducto;

class ProductoAdd
{
    public function __construct(
        private ProductoInterface $producto,
        private ValidatorInterfaceActual $validator,
        private CategoriaInterface $categoria,
        private SedesInterface $sede
    ) {}

    public function add(array $data): bool
    {
        if (!$this->validator->validateAdd($data)) {
            throw new ValidationException($this->validator->getError());
        }

        if (!$this->validator->validateId($data['id_sede'])) {
            throw new DataException('Sede no existe');
        }

        if (!$this->validator->validateId($data['id_categoria_producto'])) {
            throw new DataException('Categoria no existe');
        }

        $categoria = $this->categoria->find(['id_categoria' => $data['id_categoria_producto']]);
        $sede = $this->sede->find(['id_sede' => $data['id_sede']]);

        $producto = new Producto(0, $data['nombre'], $data['descripcion'], $data['precio'], $data['imagen_url'], $categoria[0]);

        $sedeProducto = new SedeProducto($data['id_sede'], 0, $data['stock_disponible']);

        return $this->producto->save($producto, $sedeProducto);
    }
}