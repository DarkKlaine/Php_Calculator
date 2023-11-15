<?php

namespace Engine\Services\SessionHandler;

interface ISessionHandler
{
    public function get(string $key): mixed;

    public function set(string $key, $value): void;
}