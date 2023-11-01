<?php

namespace App\DTO;

class ConfigDTO
{
    public static string $homeUrl;
    public static string $accessDeniedPage;
    public static string $loginPage;
    public static array $authWhitelist;
    public static bool $authEnabled;
    public static int $authSessionLifeTime;
    public static array $routes;

    public function __construct($appConfig)
    {
        self::$homeUrl = $appConfig['homeUrl'];
        self::$authEnabled = $appConfig['authEnabled'];
        self::$authSessionLifeTime = $appConfig['authSessionLifeTime'];
        self::$accessDeniedPage = $appConfig['authWhitelist']['accessDenied'];
        self::$loginPage = $appConfig['authWhitelist']['login'];
        self::$authWhitelist = $appConfig['authWhitelist'];
        self::$routes = $appConfig['routes'];
    }
}
