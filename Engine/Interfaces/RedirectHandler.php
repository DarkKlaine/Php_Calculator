<?php

namespace Engine\Interfaces;

use JetBrains\PhpStorm\NoReturn;

class RedirectHandler {
    #[NoReturn] public static function redirect($url): void
    {
        header("Location: " . $url);
        exit;
    }
}