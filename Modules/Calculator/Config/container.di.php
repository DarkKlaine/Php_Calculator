<?php

use App\HistoryStorage;
use Engine\Models\IAuthSessionHandler;
use Engine\Services\Container\Container;
use Engine\Services\DBConnector\IDBConnection;
use Engine\Services\RedirectHandler\IWebRedirectHandler;
use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleHistoryController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleCalculatorView;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleHistoryController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleHistoryView;
use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebCalculatorView;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryView;
use Modules\Calculator\Controllers\WebControllers\WebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\WebHistoryController;
use Modules\Calculator\Models\CalculatorModel\CalculatorModel;
use Modules\Calculator\Models\CalculatorModel\Computations\Addition;
use Modules\Calculator\Models\CalculatorModel\Computations\Divide;
use Modules\Calculator\Models\CalculatorModel\Computations\Exponentiation;
use Modules\Calculator\Models\CalculatorModel\Computations\Multiply;
use Modules\Calculator\Models\CalculatorModel\Computations\SinCosTan;
use Modules\Calculator\Models\CalculatorModel\Computations\Subtraction;
use Modules\Calculator\Models\CalculatorModel\IAddition;
use Modules\Calculator\Models\CalculatorModel\IDivide;
use Modules\Calculator\Models\CalculatorModel\IExponentiation;
use Modules\Calculator\Models\CalculatorModel\IMultiply;
use Modules\Calculator\Models\CalculatorModel\ISinCosTan;
use Modules\Calculator\Models\CalculatorModel\ISubtraction;
use Modules\Calculator\Models\HistoryModel\ConsoleHistoryDecorator;
use Modules\Calculator\Models\HistoryModel\HistoryModel;
use Modules\Calculator\Models\HistoryModel\IHistoryStorage;
use Modules\Calculator\Models\HistoryModel\WebHistoryDecorator;
use Modules\Calculator\Services\ConfigManager\CalculatorConfigManagerWeb;
use Modules\Calculator\Services\ConfigManager\ICalculatorConfigManagerWeb;
use Modules\Calculator\Views\ConsoleCalculatorView;
use Modules\Calculator\Views\ConsoleHistoryView;
use Modules\Calculator\Views\WebCalculatorView;
use Modules\Calculator\Views\WebDBHistoryView;
use Modules\Calculator\Views\WebDBUserHistoryView;
use Modules\Calculator\Views\WebHistoryView;
use Psr\Log\LoggerInterface;

return [
    //Shared
    IAddition::class => function (Container $container) {
        return new Addition($container->get(LoggerInterface::class));
    },
    ISubtraction::class => function (Container $container) {
        return new Subtraction($container->get(LoggerInterface::class));
    },
    IMultiply::class => function (Container $container) {
        return new Multiply($container->get(LoggerInterface::class));
    },
    IDivide::class => function (Container $container) {
        return new Divide($container->get(LoggerInterface::class));
    },
    IExponentiation::class => function (Container $container) {
        return new Exponentiation($container->get(LoggerInterface::class));
    },
    ISinCosTan::class => function (Container $container) {
        return new SinCosTan($container->get(LoggerInterface::class));
    },
    ICalculatorModel::class => function (Container $container) {
        return new CalculatorModel(
            $container->get(LoggerInterface::class),
            $container->get(IAddition::class),
            $container->get(ISubtraction::class),
            $container->get(IMultiply::class),
            $container->get(IDivide::class),
            $container->get(IExponentiation::class),
            $container->get(ISinCosTan::class)
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
    IWebCalculatorController::class => function (Container $container) {
        return new WebCalculatorController(
            $container->get(IWebRedirectHandler::class),
            $container->get(ICalculatorConfigManagerWeb::class),
            $container->get(ICalculatorModel::class),
            $container->get(WebHistoryDecorator::class),
            $container->get(IWebCalculatorView::class)
        );
    },
    WebHistoryController::class => function (Container $container) {
        return new WebHistoryController(
            $container->get(IWebHistoryView::class),
            $container->get(HistoryModel::class),
            $container->get(WebDBHistoryView::class),
            $container->get(WebDBUserHistoryView::class)
        );
    },
    WebHistoryDecorator::class => function (Container $container) {
        return new WebHistoryDecorator($container->get(HistoryModel::class));
    },
    IWebCalculatorView::class => function (Container $container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        $configManager = $container->get(ICalculatorConfigManagerWeb::class);

        return new WebCalculatorView($templateEngine, $configManager);
    },
    IWebHistoryView::class => function (Container $container) {
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
    IConsoleCalculatorController::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $calculatorModel = $container->get(ICalculatorModel::class);
        $historyDecorator = $container->get(ConsoleHistoryDecorator::class);
        $consoleCalculatorView = $container->get(IConsoleCalculatorView::class);

        return new ConsoleCalculatorController($logger, $calculatorModel, $historyDecorator, $consoleCalculatorView);
    },
    IConsoleHistoryController::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $historyModel = $container->get(HistoryModel::class);
        $historyView = $container->get(IConsoleHistoryView::class);

        return new ConsoleHistoryController($logger, $historyModel, $historyView);
    },
    ConsoleHistoryDecorator::class => function (Container $container) {
        $historyModel = $container->get(HistoryModel::class);

        return new ConsoleHistoryDecorator($historyModel);
    },
    IConsoleCalculatorView::class => function () {
        return new ConsoleCalculatorView();
    },
    IConsoleHistoryView::class => function () {
        return new ConsoleHistoryView();
    },
];
