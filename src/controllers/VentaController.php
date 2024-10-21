<?php

namespace Grupo3\DollarToyProyectoG3\Controllers;

use app\Business\VentaBusiness\AddVenta;
use app\Business\VentaBusiness\GetVenta;
use app\Data\VentaData;
use app\Models\DetalleVenta;
use app\Models\Venta;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class VentaController
{
    //Atributos para conexión bd
    private $validator; //opcional
    private $repository;

    public function __construct()
    {
        // $this->validator = new VentaValidator();
        $this->repository = new VentaData();
    }

    public function index()
    {

        try {
            $getVenta = new GetVenta($this->repository);
            $ventas = $getVenta->get([]);
            $content = __DIR__ . '/../views/pages/ventas/listarVentas.php';
            $title = 'Listado de Ventas';
            if ($this->isAjaxRequest()) {
                include $content; // Solo el contenido para AJAX
            } else {
                include __DIR__ . '/../views/layouts/main.php'; // Layout completo para la carga inicial
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function buscar()
    {
        $query = $_GET['query'];
        try {
            $getVenta = new GetVenta($this->repository);
            $ventas = $getVenta->get(['id' => $query]);
            if ($ventas) {
                if ($this->isAjaxRequest()) {
                    foreach ($ventas as $venta) {
                        echo "<tr>
                                <td>" . htmlspecialchars($venta->id_venta) . "</td>
                                <td>" . htmlspecialchars($venta->nombre_usuario) . "</td>
                                <td>" . htmlspecialchars($venta->cliente) . "</td>
                                <td>" . htmlspecialchars($venta->fecha_venta) . "</td>
                                <td>" . htmlspecialchars($venta->nombre_metodopago) . "</td>
                                <td>" . htmlspecialchars($venta->total) . "</td>
                                </tr>";
                    }
                } else {
                    $content = __DIR__ . '/../views/pages/ventas/listarVentas.php';
                    $title = 'Listado de Ventas';
                    include __DIR__ . '/../views/layouts/main.php'; // Layout completo para la carga inicial
                }
            } else {
                echo "No se encontraron resultados";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function nuevaVenta()
    {
        $title = 'Registrar Venta';
        $content = __DIR__ . '/../views/pages/ventas/registrarVenta.php';
        if ($this->isAjaxRequest()) {
            include $content; // Solo el contenido para AJAX
        } else {
            include __DIR__ . '/../views/layouts/main.php'; // Layout completo
        }
    }

    public function registrarVenta()
    {
        try {
            $id_usuario = $_POST['id_usuario'];
            $cliente = $_POST['cliente'];
            $fecha_venta = $_POST['fecha_venta'];
            $id_metodopago = $_POST['id_metodopago'];
            $total = $_POST['total'];
            $detalles = [];
            foreach ($_POST['detalles']['id_producto'] as $index => $id_producto) {
                $detalles[] = new DetalleVenta(
                    $id_producto,
                    $_POST['detalles']['cantidad'][$index],
                    $_POST['detalles']['precio_unitario'][$index]
                );
            }
            $venta = new Venta($id_usuario, $cliente, $fecha_venta, $id_metodopago, $total, $detalles);
            $registrar_venta = $this->repository->create($venta);
            $this->enviarEmail($cliente, $fecha_venta, $total, $detalles);
            if ($registrar_venta) {
                echo json_encode(['status' => 'success', 'message' => 'Venta registrada con éxito.']);
            }
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar la venta: ' . $e->getMessage()]);
        }
    }

    private function enviarEmail($cliente, $fecha_venta, $total, $detalles)
    {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'axelyurquina12@gmail.com'; 
        $mail->Password = 'ujpjgjzfwheoqlsf'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dollartoy@gmail.com', 'DOLLARTOY');
        $mail->addAddress('axelyurquina12@gmail.com'); 

        $mensajeHtml = "<h1>Confirmación de Venta</h1>";
        $mensajeHtml .= "<p>Cliente: $cliente</p>";
        $mensajeHtml .= "<p>Fecha de la venta: $fecha_venta</p>";
        $mensajeHtml .= "<p>Total: $total</p>";
        $mensajeHtml .= "<h2>Detalles de la compra:</h2><ul>";

        $mensajeHtml .= "</ul><p>¡Gracias por tu compra!</p>";

        $mail->isHTML(true);
        $mail->Subject = 'Confirmacion de Venta';
        $mail->Body = $mensajeHtml;

        if ($mail->send()) {
            //echo 'El correo ha sido enviado';
        } else {
            //echo 'Error al enviar correo: ' . $mail->ErrorInfo;
        }
    } catch (\Exception $e) {
        //echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }
}

    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
