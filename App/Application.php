<?php

namespace App;

class Application
{
    public static string $homeUrl;
    private object $router;

    public function __construct($appConfig)
    {
        self::$homeUrl = $appConfig['homeUrl'];
        $this->router = new Router($appConfig['routes']);
    }

    public function run():void {
        $this->router->handleRequest();
    }
}
