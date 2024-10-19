<?php

namespace app\Business\ProductosBusiness;

use app\exceptions\DataException;
use app\Interfaces\ProductoInterface;
use app\Models\Producto;
use app\Validators\ProductoValidator;


class ProductoGet 
{
    private ProductoInterface $producto;
    private ProductoValidator $validator;

    public function __construct(ProductoInterface $producto, ProductoValidator $validator)
    {
        $this->producto = $producto;
        $this->validator = $validator;
    }

    public function find(array $filters): array
    {
        if (!$this->validator->validateFind(['id_producto' => null, 'nombre' => null])) {
            throw new DataException($this->validator->getError());
        }

        $productos = $this->producto->find($filters);

        if (empty($productos)) {
            if (isset($filters['id_producto'])) {
                throw new DataException('Producto con id ' . $filters['id_producto'] . ' no encontrado');
            }
            if (isset($filters['nombre'])) {
                throw new DataException('No se encontró ningún producto con el nombre "' . $filters['nombre'] . '"');
            }
            throw new DataException('No hay productos disponibles que coincidan con los criterios');
        }
        
        return $productos;
    }
    
}

