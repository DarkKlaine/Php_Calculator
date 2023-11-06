<?php

namespace Engine;

interface IContainer
{
    /**
     * Записывает в контейнер пару ключ-значение.
     */
    public function set(string $className, \Closure $closure): void;

    /**
     * Возвращает объект класса, добавленного в контейнер ранее.
     */
    public function get(string $className): object;
}
