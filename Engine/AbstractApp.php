<?php

namespace Engine;

use Engine\Services\Container\Container;

abstract class AbstractApp
{
    protected Container $container;

    public function __construct() {
        $this->container = new Container(require_once __DIR__ . '/../Config/containerCfg.php');
    }

    abstract public function run(): void;
}
