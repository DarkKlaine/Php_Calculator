<?php

namespace Engine\App;

use Engine\App\Models\Logger\EngineLogger;

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
