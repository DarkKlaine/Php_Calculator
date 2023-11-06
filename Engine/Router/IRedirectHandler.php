<?php

namespace Engine\Router;

interface IRedirectHandler
{
    public static function redirect($url): void;
}