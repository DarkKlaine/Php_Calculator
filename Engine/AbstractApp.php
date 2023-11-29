<?php

namespace Engine;

use Engine\Services\Container\Container;

abstract class AbstractApp
{
    protected Container $container;

    public function __construct() {
        $this->container = new Container(require __DIR__ . '/../Config/containerConfig.php');
    }

    abstract public function run(): void;
}
