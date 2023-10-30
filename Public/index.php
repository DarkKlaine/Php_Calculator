<?php
session_start();

use App\Router;

require_once('../vendor/autoload.php');
$routes = require_once('../Config/routes.php');

$router = new Router($routes);
$router->handleRequest();


/** TO DO
 * почистить код
 *
 * Сделано: Создать в корне папку с конфигами "config".
 * Сделано: В эту папку поместить фал routes.php и поместить туда массив роутов, который сейчас лежит в классе Router.
 * Сделано: Этот файл должен использоваться в index.php, массив из него должен передаваться в конструктор Router.
 * Сделано: объеденить контроллеры калькулятор и УИ
 */


/** НЕ TO DO
 * Сделано: работа с сессиями, персональная история пользователя
 * Сделано: Починить отображение страницы истории, если файла нет, или он пустой.
 * Сделано: #[NoReturn] прочитать про анотации https://habr.com/ru/companies/JetBrains/articles/531828/
 * Сделано: прочитать про принцип DRY и phpdoc
 * Сделано: Почитать про уровни абстракции: https://devsday.ru/blog/details/15810
 * Сделано: stash unstash в phpstorm
 */

