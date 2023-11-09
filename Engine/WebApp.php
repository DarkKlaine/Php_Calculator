<?php

namespace Engine;

class WebApp extends Application
{
    public function run(): void
    {
        $router = $this->container->get(IWebRouter::class);
        $router->handleRequest();
    }
}