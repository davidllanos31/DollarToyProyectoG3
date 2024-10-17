<?php
$url = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];


switch ($url[0]) {

    default:
        switch ($url[1]) {
            default:
                require('categorias.php');
                break;
        }
}
