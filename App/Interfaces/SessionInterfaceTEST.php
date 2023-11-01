<?php

namespace App\Interfaces;

interface SessionInterfaceTEST {
    public function get(string $key);
    public function set(string $key, $value);
}