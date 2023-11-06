<?php

namespace Engine\Router;

use JetBrains\PhpStorm\NoReturn;

class RedirectHandler implements IRedirectHandler
{
    #[NoReturn] public static function redirect($url): void
    {
        header("Location: " . $url);
        exit;
    }
}