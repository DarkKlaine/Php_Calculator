<?php

namespace Engine;

use Engine\Services\Routers\ConsoleRouter\ConsoleRouter;

class ConsoleApp extends AbstractApp
{
    public function run(): void
    {
        $router = $this->container->get(ConsoleRouter::class);
        $router->handleRequest();
    }
}