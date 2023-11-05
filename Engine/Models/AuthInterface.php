<?php

namespace Engine\Models;

use Engine\DTO\Request;

interface AuthInterface
{
    public function verifyAuth(string $requestUrl): void;

    public function login(Request $request): void;
}