<?php

use App\HistoryStorage;
use Engine\Models\IAuthSessionHandler;
use Engine\Services\Container\Container;
use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleHistoryController;
use Modules\Calculator\Controllers\WebControllers\WebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\WebHistoryController;
use Modules\Calculator\Models\CalculatorModel\CalculatorModel;
use Modules\Calculator\Models\CalculatorModel\Computations\Addition;
use Modules\Calculator\Models\CalculatorModel\Computations\Divide;
use Modules\Calculator\Models\CalculatorModel\Computations\Exponentiation;
use Modules\Calculator\Models\CalculatorModel\Computations\Multiply;
use Modules\Calculator\Models\CalculatorModel\Computations\SinCosTan;
use Modules\Calculator\Models\CalculatorModel\Computations\Subtraction;
use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Modules\Calculator\Models\HistoryModel\IHistoryStorage;
use Modules\Calculator\Services\ConfigManager\CalculatorConfigManagerWeb;
use Modules\Calculator\Views\ConsoleCalculatorView;
use Modules\Calculator\Views\ConsoleHistoryView;
use Modules\Calculator\Views\ICalculatorConfigManagerWeb;
use Modules\Calculator\Views\WebCalculatorView;
use Modules\Calculator\Views\WebDBHistoryView;
use Modules\Calculator\Views\WebDBUserHistoryView;
use Modules\Calculator\Views\WebHistoryView;
use Psr\Log\LoggerInterface;

return [
    //Shared
    Addition::class => function (Container $container) {
        return new Addition($container->get(LoggerInterface::class));
    },
    Subtraction::class => function (Container $container) {
        return new Subtraction($container->get(LoggerInterface::class));
    },
    Multiply::class => function (Container $container) {
        return new Multiply($container->get(LoggerInterface::class));
    },
    Divide::class => function (Container $container) {
        return new Divide($container->get(LoggerInterface::class));
    },
    Exponentiation::class => function (Container $container) {
        return new Exponentiation($container->get(LoggerInterface::class));
    },
    SinCosTan::class => function (Container $container) {
        return new SinCosTan($container->get(LoggerInterface::class));
    },
    CalculatorModel::class => function (Container $container) {
        return new CalculatorModel(
            $container->get(LoggerInterface::class),
            $container->get(Addition::class),
            $container->get(Subtraction::class),
            $container->get(Multiply::class),
            $container->get(Divide::class),
            $container->get(Exponentiation::class),
            $container->get(SinCosTan::class)
        );
    },
    HistoryModel::class => function (Container $container) {
        return new HistoryModel(
            $container->get(IAuthSessionHandler::class),
            $container->get(IHistoryStorage::class)
        );
    },
    IHistoryStorage::class => function (Container $container) {
        return new HistoryStorage(
            $container->get(LoggerInterface::class), $container->get(IDBConnection::class),
        );
    },
    //Web
    ICalculatorConfigManagerWeb::class => function () {
        $appConfig = require(__DIR__ . '/../../../Config/WebCfg/app.php');

        return new CalculatorConfigManagerWeb($appConfig);
    },
    WebCalculatorController::class => function (Container $container) {
        return new WebCalculatorController(
            $container->get(IWebRedirectHandler::class),
            $container->get(ICalculatorConfigManagerWeb::class),
            $container->get(CalculatorModel::class),
            $container->get(HistoryModel::class),
            $container->get(WebCalculatorView::class)
        );
    },
    WebHistoryController::class => function (Container $container) {
        return new WebHistoryController(
            $container->get(HistoryModel::class),
            $container->get(WebDBHistoryView::class),
            $container->get(WebDBUserHistoryView::class)
        );
    },
    WebCalculatorView::class => function (Container $container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        $configManager = $container->get(ICalculatorConfigManagerWeb::class);

        return new WebCalculatorView($templateEngine, $configManager);
    },
    WebHistoryView::class => function (Container $container) {
        return new WebHistoryView(
            $container->get(IWebTemplateEngine::class),
            $container->get(ICalculatorConfigManagerWeb::class),
        );
    },
    WebDBHistoryView::class => function (Container $container) {
        return new WebDBHistoryView(
            $container->get(IWebTemplateEngine::class),
            $container->get(ICalculatorConfigManagerWeb::class),
        );
    },
    WebDBUserHistoryView::class => function (Container $container) {
        return new WebDBUserHistoryView(
            $container->get(IWebTemplateEngine::class),
            $container->get(ICalculatorConfigManagerWeb::class),
        );
    },
    //Console
    ConsoleCalculatorController::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $calculatorModel = $container->get(CalculatorModel::class);
        $historyModel = $container->get(HistoryModel::class);
        $consoleCalculatorView = $container->get(ConsoleCalculatorView::class);

        return new ConsoleCalculatorController($logger, $calculatorModel, $historyModel, $consoleCalculatorView);
    },
    ConsoleHistoryController::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $historyModel = $container->get(HistoryModel::class);
        $historyView = $container->get(ConsoleHistoryView::class);

        return new ConsoleHistoryController($logger, $historyModel, $historyView);
    },
    ConsoleCalculatorView::class => function () {
        return new ConsoleCalculatorView();
    },
    ConsoleHistoryView::class => function () {
        return new ConsoleHistoryView();
    },
];
