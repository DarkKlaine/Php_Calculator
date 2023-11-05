<?php

namespace Engine\Container;

interface ContainerInterface
{
    /**
     * Записывает в контейнер пару ключ-значение.
     */
    public function set(string $key, \Closure $getter): void;

    /**
     * Возвращает объект класса, добавленного в контейнер ранее.
     */
    public function get(string $key): object;
}
