<?php

namespace Engine;

use Engine\Container\Container;

class Application
{
    protected Container $container;
    public function __construct() {
        $this->container = new Container();
        $dependencies = require_once __DIR__ . '/../Config/ContainerCfg/containerCfg.php';
        foreach ($dependencies as $className => $closure) {
            $this->container->set($className, $closure);
        }
    }



}
