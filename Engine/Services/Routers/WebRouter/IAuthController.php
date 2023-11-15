<?php

namespace Engine\Services\Routers\WebRouter;

interface IAuthController
{
    public function accessDenied(): void;

    public function login(WebRequestDTO $request): void;
}