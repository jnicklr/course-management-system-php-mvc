<?php

namespace Framework;

class Router
{
    private array $routes = [];

    private function addRoute($uri, $controller, $action, $method)
    {
        $this->routes[$method][$uri] = ['controller' => $controller, 'action' => $action];
    }

    public function match($uri, $method): array|bool
    {
        if (!array_key_exists($uri, $this->routes[$method])){
            return false;
        }
        return $this->routes[$method][$uri];
    }

    public function get($uri, $controller, $action)
    {
        $this->addRoute($uri, $controller, $action, "GET");
    }

    public function post($uri, $controller, $action)
    {
        $this->addRoute($uri, $controller, $action, "POST");
    }
}