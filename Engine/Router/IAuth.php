<?php

namespace Engine\Router;

use Engine\DTO\Request;

interface IAuth
{
    public function verifyAuth(string $requestUrl): void;

    public function login(Request $request): void;
}