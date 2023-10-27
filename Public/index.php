<?php

use App\Router;

require_once('../vendor/autoload.php');

$router = new Router();

$requestUrl = $_SERVER['REQUEST_URI'];

$router->handleRequest($requestUrl);

// TODO
// 2. Почитать про HTTP и понять https://habr.com/ru/articles/215117/
// 4. Переработать View: https://habr.com/ru/articles/45259/
// 5. Сделать разные обработчики в CalculatorController для вывода страницы и для обработки введенных
//    для калькуляции данных. Переход между страницами сделать при помощи redirect средствами PHP.


/**
 * Сделано: DTO и передача параметров из Router в Controller
 *
 * Сделано: Написать в htaccess правило для favicon, чтобы правила не было в PHP и оно не моросило %)
 * Сделано: Должен возвращаться код ответа HTTP 404 Not Found
 */