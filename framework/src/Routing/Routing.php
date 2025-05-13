<?php
namespace Frmk\Routing;

class Routing
{
    protected static array $routes = [];

    protected static final function addRoute(string $method, string $name, string $path, callable|array $handler): void
    {        
        self::$routes[$name] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
        ];
    }
}