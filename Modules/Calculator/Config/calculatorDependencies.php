<?php

use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Engine\Services\Container\Container;
use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\ConsoleCalculatorController;
use Modules\Calculator\Controllers\HistoryControllerWeb;
use Modules\Calculator\Controllers\IAddition;
use Modules\Calculator\Controllers\ICalculatorModel;
use Modules\Calculator\Controllers\ICalculatorView;
use Modules\Calculator\Controllers\IConsoleCalculatorController;
use Modules\Calculator\Controllers\IConsoleCalculatorView;
use Modules\Calculator\Controllers\IDivide;
use Modules\Calculator\Controllers\IExponentiation;
use Modules\Calculator\Controllers\IHistoryController;
use Modules\Calculator\Controllers\IHistoryModel;
use Modules\Calculator\Controllers\IHistoryView;
use Modules\Calculator\Controllers\IMultiply;
use Modules\Calculator\Controllers\ISinCosTan;
use Modules\Calculator\Controllers\ISubtraction;
use Modules\Calculator\Controllers\IWebCalculatorController;
use Modules\Calculator\Controllers\WebCalculatorController;
use Modules\Calculator\Models\CalculatorModel;
use Modules\Calculator\Models\Computations\Addition;
use Modules\Calculator\Models\Computations\Divide;
use Modules\Calculator\Models\Computations\Exponentiation;
use Modules\Calculator\Models\Computations\Multiply;
use Modules\Calculator\Models\Computations\SinCosTan;
use Modules\Calculator\Models\Computations\Subtraction;
use Modules\Calculator\Models\HistoryModel;
use Modules\Calculator\Views\CalculatorView;
use Modules\Calculator\Views\ConsoleCalculatorView;
use Modules\Calculator\Views\HistoryView;
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
        $historyModel = $container->get(IHistoryModel::class);
        $calculatorView = $container->get(ICalculatorView::class);
        return new WebCalculatorController($redirectHandler, $logger, $configManager, $calculatorModel, $historyModel, $calculatorView,);
    },
    IHistoryController::class => function (Container $container) {
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $historyView = $container->get(IHistoryView::class);
        $historyModel = $container->get(IHistoryModel::class);
        return new HistoryControllerWeb($redirectHandler, $logger, $configManager, $historyView, $historyModel,);
    },
    ICalculatorView::class => function (Container $container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new CalculatorView($templateEngine);
    },
    IHistoryView::class => function (Container $container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new HistoryView($templateEngine);
    },
    //Console
    IConsoleCalculatorController::class => function (Container $container) {
        $logger = $container->get(LoggerInterface::class);
        $calculatorModel = $container->get(ICalculatorModel::class);
        $historyModel = $container->get(IHistoryModel::class);
        $consoleCalculatorView = $container->get(IConsoleCalculatorView::class);
        return new ConsoleCalculatorController($logger, $calculatorModel, $historyModel, $consoleCalculatorView);
    },
    IConsoleCalculatorView::class => function () {
        return new ConsoleCalculatorView();
    },
];
