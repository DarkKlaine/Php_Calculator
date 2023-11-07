<?php

namespace Engine;

use Engine\Container\Container;

class Application
{
    public function run(): void
    {
        $container = new Container();
        $dependencies = require("../Config/ContainerCfg/containerCfg.php");
        foreach ($dependencies as $className => $closure) {
            $container->set($className, $closure);
        }

        $router = $container->get(IRouter::class);
        $router->handleRequest();
    }
}
