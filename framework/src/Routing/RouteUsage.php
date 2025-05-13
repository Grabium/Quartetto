<?php
namespace Frmk\Routing;

class RouteUsage extends Routing
{
    private static function getHTTPPath(): string
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $path = strtok($requestUri, '?');
        return $path;
    }

    private static function getNotNamedRoute(): array
    {
        $pathHTTP = self::getHTTPPath();

        foreach(parent::$routes as $route){
            if(($route['path'] == $pathHTTP)&&($route['method'] == $_SERVER['REQUEST_METHOD'])){
                return $route;
            }
        }

        echo 'Method \''.$_SERVER['REQUEST_METHOD'].'\' não inscrito no caminho: \''.$pathHTTP.'\'.'.PHP_EOL;
        die();
    }

    private static function getNamedRoute(string $name): array
    {
        if(!isset(parent::$routes[$name])){
            echo 'Erro: rota '.$name.' não encontrada!'.PHP_EOL;
            die();
        }

        $route = parent::$routes[$name];

        $pathHTTP = self::getHTTPPath();
        
        if($route['path'] != $pathHTTP){
            echo 'Caminho: \''.$pathHTTP.'\' não inscrito na rota \''.$name.'.'.PHP_EOL;
            die();
        }

        if($route['method'] != $_SERVER['REQUEST_METHOD']){
            echo 'Method: \''.$_SERVER['REQUEST_METHOD'].'\' não inscrito na rota \''.$name.'\'.'.PHP_EOL;
            die();
        }

        return $route;

    }

    public final static function resolve(string|null $name)
    {
        $route = ($name != null) ? self::getNamedRoute($name): self::getNotNamedRoute();
            
        //chamar middlewares aqui.
        

        //Resolve query mas não resolve parametros não nomeados.
        if (is_callable($route['handler'])) {
            call_user_func($route['handler']);
        
        } elseif (is_array($route['handler'])) {

            $clss = new $route['handler'][0]();//class
            $mthd = $route['handler'][1];//method
            $clss->$mthd();

        } else {
            echo "Erro: hanlder inválido. Rota '{$name}:'.\n";
            var_dump($route['handler']);
            die();
        }
        
    }
}