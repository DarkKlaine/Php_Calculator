<?php

namespace Engine\Router;

interface IWebRedirectHandler
{
    public static function redirect($url): void;
}