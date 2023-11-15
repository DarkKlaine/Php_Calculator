<?php

namespace Engine\Services\Routers\WebRouter;

interface IWebRedirectHandler
{
    public static function redirect($url): void;
}