<?php

namespace Engine\Router;

use Engine\DTO\WebRequestDTO;

interface IAuthController
{
    public function accessDenied(): void;

    public function login(WebRequestDTO $request): void;
}