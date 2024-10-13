<?php

namespace app\routes;

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function run()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    $baseUri = '/DollarToyProyectoG3';
    if (strpos($uri, $baseUri) === 0) {
        $uri = substr($uri, strlen($baseUri));
    }

    echo "URI ajustada: {$uri}<br>";

    if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {
        [$controller, $method] = $this->routes[$method][$uri];
        $controllerInstance = new $controller();
        $controllerInstance->$method();
    } else {
        $this->handleDynamicRoutes($uri, $method);
    }
}


    private function debugRoutes($method)
    {
        if (isset($this->routes[$method])) {
            echo "Rutas registradas para el método {$method}:<br>";
            foreach ($this->routes[$method] as $uri => $action) {
                echo "- {$uri} -> " . implode(", ", $action) . "<br>";
            }
        }
    }

    private function handleDynamicRoutes($uri, $method)
    {
        foreach ($this->routes[$method] as $route => $action) {
            if ($params = $this->getRouteParams($uri, $route)) {
                $controllerInstance = new $action[0]();
                call_user_func_array([$controllerInstance, $action[1]], $params);
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada para la URI: {$uri}";
    }

    private function getRouteParams($uri, $route)
    {
        $routePattern = preg_replace('#\{(\w+)\}#', '(\w+)', $route);
        if (preg_match("#^{$routePattern}$#", $uri, $matches)) {
            return array_slice($matches, 1);
        }
        return [];
    }
}
