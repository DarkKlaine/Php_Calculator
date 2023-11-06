<?php

namespace Engine;

use Engine\Container\Container;
use Engine\Router\Router;

class Application
{
    public function run(): void
    {
        $container = new Container();
        $dependencies = require ("../Config/containerConfig.php");
        foreach ($dependencies as $className => $closure) {
            $container->set($className, $closure);
        }

        $router = $container->get(Router::class);
        $router->handleRequest();
    }
}
