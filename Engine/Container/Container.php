<?php

namespace Engine\Container;

use Engine\IContainer;
use Exception;

class Container implements IContainer
{
    private array $dependencies = [];

    public function set(string $className, \Closure $closure): void
    {
        $this->dependencies[$className] = $closure;
    }

    /**
     * @throws Exception
     */
    public function get(string $className): object
    {
        if (isset($this->dependencies[$className])) {
            return $this->dependencies[$className]($this);
        }
        throw new Exception("Зависимость '$className' не найдена в контейнере.");
    }
}
