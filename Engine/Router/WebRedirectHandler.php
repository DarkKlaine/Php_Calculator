<?php

namespace Engine\Router;

use JetBrains\PhpStorm\NoReturn;

class WebRedirectHandler implements IWebRedirectHandler
{
    #[NoReturn] public static function redirect($url): void
    {
        header("Location: " . $url);
        exit;
    }
}