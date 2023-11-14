<?php

namespace Engine;

class ConsoleApp extends AbstractApp
{
    public function run(): void
    {
        $router = $this->container->get(IConsoleRouter::class);
        $router->handleRequest();
    }
}