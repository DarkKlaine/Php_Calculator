<?php

namespace Engine;

class WebApp extends MainApp
{
    public function run(): void
    {
        $router = $this->container->get(IWebRouter::class);
        $router->handleRequest();
    }
}