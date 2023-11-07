<?php

namespace Engine\Router;

use Engine\DTO\Request;

interface IAuthController
{
    public function accessDenied(): void;

    public function login(Request $request): void;
}