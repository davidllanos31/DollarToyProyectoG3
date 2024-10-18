<?php

namespace app\Business\CategoriaBusiness;

use app\exceptions\DataException;
use app\Interfaces\CategoriaInterface;
use app\interfaces\ValidatorInterfaceActual;

class CategoriaGet
{
    private CategoriaInterface $categoria;
    private ValidatorInterfaceActual $validator;

    public function __construct(CategoriaInterface $categoria, ValidatorInterfaceActual $validator)
    {
        $this->categoria = $categoria;
        $this->validator = $validator;
    }

    public function find(array $filters): array
    {
        if (!$this->validator->validateFind(['id_categoria' => null, 'nombre' => null])) {
            throw new DataException($this->validator->getError());
        }

        $categorias = $this->categoria->find($filters);

        if (empty($categorias)) {
            if (isset($filters['id_categoria'])) {
                throw new DataException('Categoria con id ' . $filters['id_categoria'] . ' no encontrado');
            }
            if (isset($filters['nombre'])) {
                throw new DataException('No se encontró ningún categoria con el nombre "' . $filters['nombre'] . '"');
            }
            throw new DataException('No hay categorias disponibles que coincidan con los criterios');
        }
        
        return $categorias;
    }
}