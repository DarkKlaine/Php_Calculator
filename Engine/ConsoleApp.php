<?php

namespace Engine;

class ConsoleApp extends MainApp
{
    public function run(): void
    {
        $router = $this->container->get(IConsoleRouter::class);
        $router->handleRequest();
    }
}