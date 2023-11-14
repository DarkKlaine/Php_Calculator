<?php

namespace Engine\Router\WebRouter;

interface IWebRedirectHandler
{
    public static function redirect($url): void;
}