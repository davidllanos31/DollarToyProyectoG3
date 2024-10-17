<?php
$url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

if (isset($_POST) && !empty($_POST)) {
    switch ($url[1]) {
            // case 'GET':
            //     require_once 'get.php';
            //     break;

            // case 'POST':
            //     require_once 'post.php';
            //     break;

            // case 'PUT':
            //     require_once 'update.php';
            //     break;

            // case 'DELETE':
            //     require_once 'delete.php';
            //     break;

        default:
            require('post.php');
            break;
    }
    exit();
} else {
    switch ($url[0]) {

        default:
            switch ($url[1]) {
                default:
                    require('categorias.php');
                    break;
            }
    }
}
