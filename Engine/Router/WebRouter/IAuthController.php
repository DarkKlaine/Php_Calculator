<?php

namespace Engine\Router\WebRouter;

interface IAuthController
{
    public function accessDenied(): void;

    public function login(WebRequestDTO $request): void;
}