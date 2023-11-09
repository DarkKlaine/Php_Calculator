<?php

namespace Engine\Router;

use Engine\DTO\WebRequestDTO;

interface IAuth
{
    public function verifyAuth(string $requestUrl): void;

    public function login(WebRequestDTO $request): void;
}