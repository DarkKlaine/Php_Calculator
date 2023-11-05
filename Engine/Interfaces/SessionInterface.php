<?php

namespace Engine\Interfaces;

interface SessionInterface {
    public function get(string $key);
    public function set(string $key, $value);
}