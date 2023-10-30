<?php

namespace App;

class Application
{
    public static string $homeUrl;
    private array $routes;

    public function __construct($appConfig)
    {
        self::$homeUrl = $appConfig['homeUrl'];
        $this->routes = $appConfig['routes'];
    }

    public function run():void {
        $router = new Router($this->routes);
        $router->handleRequest();
    }
}
