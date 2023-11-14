<?php

namespace Engine\Services\Container;

use Exception;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $dependencies;

    public function __construct(array $dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @throws Exception
     */
    public function get(string $id): object
    {
        if ($this->has($id)) {
            return $this->dependencies[$id]($this);
        }
        throw new Exception("Зависимость '$id' не найдена в контейнере.");
    }

    public function has(string $id): bool
    {
        return isset($this->dependencies[$id]);
    }
}
