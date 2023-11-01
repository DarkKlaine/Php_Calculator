<?php

namespace App;

class Application
{
    public static string $homeUrl;
    private static bool $authEnabled;
    private object $router;

    public function __construct($appConfig)
    {
        self::$homeUrl = $appConfig['homeUrl'];
        self::$authEnabled = $appConfig['authEnabled'];
        $this->router = new Router($appConfig['routes']);
    }

    public function run():void {
        if (self::$authEnabled) {
            echo 'TODO';
            //TODO
        }
        $this->router->handleRequest();
    }
}
