<?php

use App\Router;

require_once('../vendor/autoload.php');

$run = new Router();

$requestUrl = $_SERVER['REQUEST_URI'];

if ($requestUrl === '/favicon.ico') {
    return;
}

$run->handleRequest($requestUrl);


/**
 * Сделано: Apache redirect в index.php
 * Сделано: сделать BaseController и от него сделать 2 наследника CalculatorController и HistoryController
 * Сделано: В роутере в зависимости от адреса обращения запускать какой-то из них методом run
 * Cделано: Исправить вывод если ответ НОЛЬ
 * Сделано: Исправить обработку отрицательных значений ввода
 */