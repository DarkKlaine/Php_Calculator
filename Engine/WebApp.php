<?php

namespace Engine;

use Engine\Services\Routers\WebRouter\WebRouter;

class WebApp extends AbstractApp
{
    public function run(): void
    {
        $router = $this->container->get(WebRouter::class);
        $router->handleRequest();
    }
}