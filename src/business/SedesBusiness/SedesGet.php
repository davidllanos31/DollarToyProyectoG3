<?php

namespace app\Business\SedesBusiness;

use app\exceptions\DataException;
use app\Interfaces\ValidatorInterfaceActual;
use app\Interfaces\SedesInterface;
use app\Exceptions\ValidationException;
use app\Models\Sedes;

class SedesGet
{
    private SedesInterface $sedes;
    private ValidatorInterfaceActual $validator;

    public function __construct(SedesInterface $sedes, ValidatorInterfaceActual $validator)
    {
        $this->sedes = $sedes;
        $this->validator = $validator;
    }

    public function find(array $filters): array
    {
        if (!$this->validator->validateFind(['id_sede' => null, 'nombre' => null])) {
            throw new DataException($this->validator->getError());
        }

        $sedes = $this->sedes->find($filters);

        if (empty($sedes)) {
            if (isset($filters['id_sede'])) {
                throw new DataException('Sede con id ' . $filters['id_sede'] . ' no encontrado');
            }
            if (isset($filters['nombre'])) {
                throw new DataException('No se encontró ninguna sede con el nombre "' . $filters['nombre'] . '"');
            }
            throw new DataException('No hay sedes disponibles que coincidan con los criterios');
        }
        
        return $sedes;
    }
}
?>