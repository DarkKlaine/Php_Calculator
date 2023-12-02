<?php

namespace Engine\Services\RedirectHandler;

interface IWebRedirectHandler
{
    public static function redirect($url): void;
}
