<?php

namespace Engine\Services\Routers\WebRouter;

interface IAuth
{
    public function verifyAuth(string $requestUrl): void;

    public function login(WebRequestDTO $request): void;
}