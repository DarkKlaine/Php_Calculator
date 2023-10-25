<?php
// index.php
header("Location: Public/index.php");
exit( );

/**
   calculator.loc (directory)
    App (directory)
        controllers (directory)
            CalculatorController.php -
                - Класс от которо будут экстендиться остальные контроллеры.
                - Создать если контроллеров больше чем 1 и/или если это необходимо.
            CalculatorController.php -
                - Контроллер калькулятора принимает данные от пользователя,
                - обрабатывает и определяет куда их отправить.
                - Получает результат из модели, отправляет его в вид.

        Models (directory)
            computations (directory)
                Computation.php - главный абстрактный класс
                Addition.php extends Computation - сложение и прочие математические функции
                ...

            logger (directory)
                psr (directory)  - пср логгер, основные классы
                    LoggerInterface.php
                    LogLevel.php
                    ...
                CalculatorLogger.php - Имплемент от ПСР логер интерфейса
                    - обработка логов калькулятора
                    - принимает готовую строку для логирования, уровень логирования
                    - обрабатывает её согласно плана и записывает в лог
                    ??? кто её отправляет, контроллер или другой метод из модели?

            CalculatorErrorHandler.php - получает и обрабатывает ошибки
                - сюда контроллер будет отправлять неправильный ввод,
                ??? другие классы будут отправлять ошибки
                - отсюда

        Views (directory)
            View.php -
                - Класс от которо будут экстендиться остальные в view хранит общий шаблон
                - Создать если страниц больше чем 1 и/или если это необходимо.
            CalculatorView.php -
                - Хранит в себе шаблон страницы
                - Получает данные от контроллера, заполняет ими страницу
                - Отображает страницу пользователю

    Public (directory)
        index.php -
            - Точка входа в приложение. Содержит в себе только обращение к контроллеру.
            ??? Тут не совсем понятно как пользователь сразу увидит блок ввода данных из Вида

    Log (directory)
        calculations.Log и другие логи
 */