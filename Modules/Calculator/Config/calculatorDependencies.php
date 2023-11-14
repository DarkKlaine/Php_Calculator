<?php

use Engine\Router\WebRouter\IWebConfigManager;
use Engine\Router\WebRouter\IWebRedirectHandler;
use Engine\Services\Container\Container;
use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\ConsoleHistoryController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleCalculatorController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleCalculatorView;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleHistoryController;
use Modules\Calculator\Controllers\ConsoleControllers\IConsoleHistoryView;
use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Controllers\IHistoryModel;
use Modules\Calculator\Controllers\WebControllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebControllers\IWebCalculatorView;
use Modules\Calculator\Controllers\WebControllers\IWebHistoryController;
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
use Modules\Calculator\Models\HistoryModel\WebHistoryDecorator;
use Modules\Calculator\Views\ConsoleCalculatorView;
use Modules\Calculator\Views\ConsoleHistoryView;
use Modules\Calculator\Views\WebCalculatorView;
use Modules\Calculator\Views\WebHistoryView;
use Psr\Log\LoggerInterface;

return [
    //Shared
    IAddition::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        return new Addition($logger);
    },
    ISubtraction::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        return new Subtraction($logger);
    },
    IMultiply::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        return new Multiply($logger);
    },
    IDivide::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        return new Divide($logger);
    },
    IExponentiation::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        return new Exponentiation($logger);
    },
    ISinCosTan::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        return new SinCosTan($logger);
    },
    ICalculatorModel::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $addition = $container->get(IAddition::class);
        $subtraction = $container->get(ISubtraction::class);
        $multiply = $container->get(IMultiply::class);
        $divide = $container->get(IDivide::class);
        $exponentiation = $container->get(IExponentiation::class);
        $sinCosTan = $container->get(ISinCosTan::class);
        return new CalculatorModel($logger, $addition, $subtraction, $multiply, $divide, $exponentiation, $sinCosTan);
    },
    IHistoryModel::class => function () {
        return new HistoryModel();
    },
    //Web
    IWebCalculatorController::class => function (Container $container) {
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $calculatorModel = $container->get(ICalculatorModel::class);
        $historyDecorator = $container->get(WebHistoryDecorator::class);
        $calculatorView = $container->get(IWebCalculatorView::class);
        return new WebCalculatorController($redirectHandler, $logger, $configManager, $calculatorModel, $historyDecorator, $calculatorView,);
    },
    IWebHistoryController::class => function (Container $container) {
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $historyView = $container->get(IWebHistoryView::class);
        $historyModel = $container->get(IHistoryModel::class);
        return new WebHistoryController($redirectHandler, $logger, $configManager, $historyView, $historyModel,);
    },
    WebHistoryDecorator::class => function (Container $container) {
        $historyModel = $container->get(IHistoryModel::class);
        return new WebHistoryDecorator($historyModel);
    },
    IWebCalculatorView::class => function (Container $container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new WebCalculatorView($templateEngine);
    },
    IWebHistoryView::class => function (Container $container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new WebHistoryView($templateEngine);
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
        $historyModel = $container->get(IHistoryModel::class);
        $historyView = $container->get(IConsoleHistoryView::class);
        return new ConsoleHistoryController($logger, $historyModel, $historyView);
    },
    ConsoleHistoryDecorator::class => function (Container $container) {
        $historyModel = $container->get(IHistoryModel::class);
        return new ConsoleHistoryDecorator($historyModel);
    },
    IConsoleCalculatorView::class => function () {
        return new ConsoleCalculatorView();
    },
    IConsoleHistoryView::class => function () {
        return new ConsoleHistoryView();
    },
];
