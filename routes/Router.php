<?php

namespace Router;

class Router {

    public $url;
    public $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    /**
     * Function get : return the path with the method GET
     */
    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    /**
     * Function post : return the path with the method POST
     */
    public function post(string $path, string $action)
    {
        $route = new Route($path, $action);
        $this->routes['POST'][] = $route;
        return $route; // On retourne la route pour "enchaîner" les méthodes
    }

    /**
     * Function run : return
     */
    public function run()
    {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->matches($this->url))
            {
                return $route->execute();
            }
        }

        return header('HTTP/1.0 404 Not Found');
    }
}