<?php

namespace app\Business\CategoriaBusiness;

use app\Interfaces\ValidatorInterfaceActual;
use app\Interfaces\CategoriaInterface;
use app\Exceptions\ValidationException;
use app\exceptions\DataException;

class CategoriaUpdate
{
    private CategoriaInterface $categoria;
    private ValidatorInterfaceActual $validator;

    public function __construct(CategoriaInterface $categoria, ValidatorInterfaceActual $validator)
    {
        $this->categoria = $categoria;
        $this->validator = $validator;
    }

    public function updateById($id, $data): string
    {
        if (!$this->validator->validateId($id)) {
            throw new ValidationException($this->validator->getError());
        }

        if (!$this->validator->validateUpdate($data)) {
            throw new ValidationException($this->validator->getError());
        }

        if (!$this->categoria->exists((int)$data['id'])) {
            throw new DataException('Categoria con id '.$id.' no encontrado');
        }

        $categoria = $this->categoria->find(['id_categoria' => $id]);

        $this->categoria->save($categoria[0]);

        return "Categoria con id ". $categoria[0]->getId() ." actualizado con éxito";
    }
}