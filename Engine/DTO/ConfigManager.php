<?php

namespace Engine\DTO;

class ConfigManager
{
    private static string $homeUrl;
    private static string $accessDeniedPage;
    private static string $loginPage;
    private static array $authWhitelist;
    private static bool $authEnabled;
    private static int $authSessionLifeTime;
    private static array $routes;

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

    public static function getAccessDeniedPage(): string
    {
        return self::$accessDeniedPage;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getAuthSessionLifeTime(): int
    {
        return self::$authSessionLifeTime;
    }

    public static function isAuthEnabled(): bool
    {
        return self::$authEnabled;
    }

    public static function getAuthWhitelist(): array
    {
        return self::$authWhitelist;
    }

    public static function getLoginPage(): string
    {
        return self::$loginPage;
    }

    public static function getHomeUrl(): string
    {
        return self::$homeUrl;
    }
}
