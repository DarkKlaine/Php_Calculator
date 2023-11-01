<?php

namespace App;

class Application
{
    public static string $homeUrl;
    private static bool $authEnabled;
    private object $auth;
    private object $router;

    public function __construct($appConfig)
    {
        self::$homeUrl = $appConfig['homeUrl'];
        self::$authEnabled = $appConfig['authEnabled'];
        $this->router = new Router($appConfig['routes']);
        $this->auth = new Auth($appConfig);
    }

    public function run(): void
    {
        if (self::$authEnabled) {
            $this->auth->verifyAuth();
        }
        $this->router->handleRequest();
    }
}
