<?php

namespace App;

use App\DTO\ConfigDTO;

class Application
{
    private object $router;

    public function __construct()
    {
        $this->router = new Router(new EngineLogger());
    }

    public function run(): void
    {
        $this->router->handleRequest();
    }
}
