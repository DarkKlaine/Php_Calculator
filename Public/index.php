<?php

use App\Router;

require_once('../vendor/autoload.php');

$router = new Router();

$router->handleRequest();

// TODO
// работа с сессиями
// $_SESSION

// Начало сессии
// session_start();
//
// Установка значения в $_SESSION
// $_SESSION['username'] = 'John';
//
// Получение значения из $_SESSION
// $username = $_SESSION['username'];
//
// Удаление значения из $_SESSION
// unset($_SESSION['username']);
//
// Завершение сессии
// session_destroy();

/**
 * Сделано: Сделать разные обработчики в CalculatorController для вывода страницы и для обработки введенных
 *     для калькуляции данных. Переход между страницами сделать при помощи redirect средствами PHP.
 * Сделано: Переработать View: https://habr.com/ru/articles/45259/
 * Сделано: DTO и передача параметров из Router в Controller
 * Сделано: Почитать про HTTP и понять https://habr.com/ru/articles/215117/
 * Сделано: Написать в htaccess правило для favicon, чтобы правила не было в PHP и оно не моросило %)
 * Сделано: Должен возвращаться код ответа HTTP 404 Not Found
 */

