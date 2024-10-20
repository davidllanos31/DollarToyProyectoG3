<?php


require __DIR__ . '/../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
class Lib_props {
    
    function productosArray($productos) {
        return array_map(function($producto) {
            return [
                'id_producto' => $producto->getId(),
                'nombre' => $producto->getNombre(),
                'descripcion' => $producto->getDescripcion(),
                'precio' => $producto->getPrecio(),
                'imagen_url' => $producto->getImg(),
                'id_categoria_producto' => $producto->getCategoria()
            ];
        }, $productos);
    }
    function generarEnlaceExcel($productos) {
        return BASE_URI . '/src/controllers/lib_props.php?productos=' . urlencode(json_encode($this->productosArray($productos)));
    }
    
    public function ProductosExcel(array $datos) {
        $excel = new Spreadsheet();
        $fecha = date("Y-m-d"); 

        ###########################################
        ######### ESTILOS
        ###########################################
        $estiloColumnasTitulo = [
            'font' => [
                'name' => 'Calibri',
                'bold' => true,
                'color' => ['rgb' => '000000'],
                'size' => 11
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'ECF0F1']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ]
        ];

        $estiloColumnasPar = $this->estiloFila(false);
        $estiloColumnasImpar = $this->estiloFila(true);

        $excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloColumnasTitulo);
        $excel->getActiveSheet()->setCellValue('A1', 'ID');
        $excel->getActiveSheet()->setCellValue('B1', 'Nombre');
        $excel->getActiveSheet()->setCellValue('C1', 'Descripción');
        $excel->getActiveSheet()->setCellValue('D1', 'Precio');
        $excel->getActiveSheet()->setCellValue('E1', 'Imagen');
        $excel->getActiveSheet()->setCellValue('F1', 'Stock');

        
        $row = 2; 
        foreach ($datos as $producto) {
            
            $excel->getActiveSheet()->setCellValue('A' . $row, $producto['id_producto']);
            $excel->getActiveSheet()->setCellValue('B' . $row, $producto['nombre']);
            $excel->getActiveSheet()->setCellValue('C' . $row, $producto['descripcion']);
            $excel->getActiveSheet()->setCellValue('D' . $row, $producto['precio']);
            $excel->getActiveSheet()->setCellValue('E' . $row, $producto['imagen_url']);
            $excel->getActiveSheet()->setCellValue('F' . $row, 'hola'); 

            if ($row % 2 == 0)
                $excel->getActiveSheet()->getStyle("A$row:F$row")->applyFromArray($estiloColumnasPar);
            else
                $excel->getActiveSheet()->getStyle("A$row:F$row")->applyFromArray($estiloColumnasImpar);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="PRODUCTOS_' . $fecha . '.xlsx"');
        header('Cache-Control: max-age=0');

        foreach (range('A', 'F') as $column) {
            $excel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
        }

        // Guardar el archivo
        $writer = new Xlsx($excel);
        $writer->save('php://output');
        exit(); // Termina el script
    }

    public function CategoriasExcel(array $datos) {
        $excel = new Spreadsheet();
        $fecha = date("Y-m-d"); 

        ###########################################
        ######### ESTILOS
        ###########################################
        $estiloColumnasTitulo = [
            'font' => [
                'name' => 'Calibri',
                'bold' => true,
                'color' => ['rgb' => '000000'],
                'size' => 11
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'ECF0F1']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ]
        ];

        $estiloColumnasPar = $this->estiloFila(false);
        $estiloColumnasImpar = $this->estiloFila(true);

        $excel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($estiloColumnasTitulo);
        $excel->getActiveSheet()->setCellValue('A1', 'ID');
        $excel->getActiveSheet()->setCellValue('B1', 'Nombre');
        $excel->getActiveSheet()->setCellValue('C1', 'Descripción');

        
        $row = 2; 
        foreach ($datos as $categoria) {
            $excel->getActiveSheet()->setCellValue('A' . $row, $categoria['id_categoria']);
            $excel->getActiveSheet()->setCellValue('B' . $row, $categoria['nombre']);
            $excel->getActiveSheet()->setCellValue('C' . $row, $categoria['descripcion']);

            if ($row % 2 == 0)
                $excel->getActiveSheet()->getStyle("A$row:C$row")->applyFromArray($estiloColumnasPar);
            else
                $excel->getActiveSheet()->getStyle("A$row:C$row")->applyFromArray($estiloColumnasImpar);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="CATEGORIAS_' . $fecha . '.xlsx"');
        header('Cache-Control: max-age=0');

        foreach (range('A', 'C') as $column) {
            $excel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
        }

        $writer = new Xlsx($excel);
        $writer->save('php://output');
        exit(); 
    }

    private function estiloFila($impar) {
        $color = $impar ? 'DCDCDCDC' : 'FFFFFFFF';
        return [
            'font' => [
                'name' => 'Calibri',
                'bold' => false,
                'color' => ['rgb' => '000000']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => $color]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
    }
}

if (isset($_GET['productos'])) {
    $productos = json_decode(urldecode($_GET['productos']), true);
    $lib_props = new Lib_props();
    $lib_props->ProductosExcel($productos);
}



