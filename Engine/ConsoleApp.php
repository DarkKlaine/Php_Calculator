<?php

namespace Engine;

class ConsoleApp extends Application
{
    public function run(): void
    {
        $router = $this->container->get(IConsoleRouter::class);
        $router->handleRequest();
    }
}