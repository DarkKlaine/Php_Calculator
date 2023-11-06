<?php

namespace Engine\Services;

interface ISessionHandler {
    public function get(string $key);
    public function set(string $key, $value);
}