<?php

namespace Engine;

class WebApp extends AbstractApp
{
    public function run(): void
    {
        $router = $this->container->get(IWebRouter::class);
        $router->handleRequest();
    }
}