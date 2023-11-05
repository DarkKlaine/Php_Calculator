<?php

namespace Engine\App;

class Application
{
    private object $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run(): void
    {
        $this->router->handleRequest();
    }
}
