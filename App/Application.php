<?php

namespace App;

use App\DTO\ConfigDTO;

class Application
{
    private object $auth;
    private object $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->auth = new Auth();
    }

    public function run(): void
    {
        if (ConfigDTO::$authEnabled) {
            $this->auth->verifyAuth();
        }
        $this->router->handleRequest();
    }
}
