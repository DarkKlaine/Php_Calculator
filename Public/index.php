<?php
session_start();

use App\Router;

require_once('../vendor/autoload.php');
$configApp = require_once('../Config/app.php');

$router = new Router($configApp['routes']);
$router->handleRequest();


/** TO DO
 * Почистить код - это дейлик. :)
 * php code sniffer (phpcs для phpstorm)
 *
 * 1. Добавить основной конфиг приложения app.php
 * В нем у тебя должны быть два параметра (читай "подмассива") с ключами
 * - routes - твои роуты, которые должны подключаться сюда из файла
 * - homeUrl - адрес домашней страницы, куда будут вести всякие там редиректы
 *
 * 2. Добавить новый класс движка - Application.
 * С него должна начинаться работа твоего приложения.
 * К нему в конструктор (!!!) передается конфиг app.php.
 * После чего, в index.php вызывается метод run() объекта Application.
 *
 * В ходе работы метода run должен запуститься роутер и отработать, как и раньше.
 *
 * У класса Application должно быть статичное свойство homeUrl, которое нужно использовать в местах, где ты делаешь редирект на домашнюю страницу.
 *
 * 3. Закрыть все страницы авторизацией.
 * Если пользователь не авторизовался - мы показываем ему ошибку "Тебе тут не рады" и даем ссылку на страницу с формой авторизации.
 *
 * На странице с формой авторизации пользователю предлагают ввести логин и пароль.
 *
 * Логин и пароль должны храниться в конфиге.
 *
 * Пользователей должно быть несколько (3)
 *
 * Авторизованная сессия должна протухать через 5 минут
 *
 */


/** НЕ TO DO
 * Сделано: Заменить в BaseController try-catch на method_exists()
 * Сделано: Убрать action в DTO
 */

