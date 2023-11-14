<?php

namespace Engine\Router\WebRouter;

interface IAuth
{
    public function verifyAuth(string $requestUrl): void;

    public function login(WebRequestDTO $request): void;
}