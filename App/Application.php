<?php

namespace App;

class Application
{
    public static string $homeUrl;
    private static bool $authEnabled;
    private object $router;
    private array $appConfig;

    public function __construct($appConfig)
    {
        $this->appConfig = $appConfig;
        self::$homeUrl = $appConfig['homeUrl'];
        self::$authEnabled = $appConfig['authEnabled'];
        $this->router = new Router($appConfig['routes']);
    }

    public function run():void {
        if (self::$authEnabled) {
            (new Auth($this->appConfig))->verifyAuth();
        }
        $this->router->handleRequest();
    }
}
