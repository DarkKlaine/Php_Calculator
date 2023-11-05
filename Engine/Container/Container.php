<?php

namespace Engine\Container;

use Exception;

class Container implements IContainer
{
    private array $dependencies = [];

    public function set(string $key, \Closure $getter): void
    {
        $this->dependencies[$key] = $getter;
    }

    /**
     * @throws Exception
     */
    public function get(string $key): object
    {
        if (isset($this->dependencies[$key])) {
            return $this->dependencies[$key]($this);
        }
        throw new Exception("Зависимость '$key' не найдена в контейнере.");
    }
}
