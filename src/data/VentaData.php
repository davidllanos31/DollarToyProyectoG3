<?php
namespace app\Data;

use PDO;
use app\Data\BaseData;

class VentaData extends BaseData implements VentaInterface
{   
    const TABLE = 'tb_ventas';

    public function get(): array {

    }
}