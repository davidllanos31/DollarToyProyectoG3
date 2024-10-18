<?php
namespace app\Business\SedesBusiness;

use app\Interfaces\ValidatorInterfaceActual;
use app\Interfaces\SedesInterface;
use app\Exceptions\ValidationException;
use app\Models\Sedes;

class SedesAdd
{
    private SedesInterface $sedes;
    private ValidatorInterfaceActual $validator;

    public function __construct(SedesInterface $sedes, ValidatorInterfaceActual $validator)
    {
        $this->sedes = $sedes;
        $this->validator = $validator;
    }

    public function add($data)
    {
        if (!$this->validator->validateAdd($data)) {
            throw new ValidationException($this->validator->getError());
        }

        $sedes = new Sedes(0, $data['nombre'], $data['direccion'], $data['ciudad']);

        $this->sedes->save($sedes);
    }
}