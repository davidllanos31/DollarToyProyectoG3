<?php

use app\Controllers\CategoriaController;

$categoriaController = new CategoriaController();

switch ($_POST['action']) {
    case 'create':
        $categoriaController->create();
        break;
    case 'update':
        $categoriaController->update($_POST['id']);
        break;
    case 'delete':
        $categoriaController->delete($_POST['id']);
        break;
    default:
        echo "Acción no soportada";
        break;
}