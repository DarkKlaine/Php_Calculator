<?php

use Engine\Router\IWebConfigManager;
use Engine\Router\IWebRedirectHandler;
use Engine\Services\Container\Container;
use Engine\Views\IWebTemplateEngine;
use Modules\Calculator\Controllers\CalculatorController;
use Modules\Calculator\Controllers\HistoryController;
use Modules\Calculator\Controllers\IAddition;
use Modules\Calculator\Controllers\ICalculatorController;
use Modules\Calculator\Controllers\ICalculatorView;
use Modules\Calculator\Controllers\IDivide;
use Modules\Calculator\Controllers\IExponentiation;
use Modules\Calculator\Controllers\IHistoryController;
use Modules\Calculator\Controllers\IHistoryModel;
use Modules\Calculator\Controllers\IHistoryView;
use Modules\Calculator\Controllers\IMultiply;
use Modules\Calculator\Controllers\ISinCosTan;
use Modules\Calculator\Controllers\ISubtraction;
use Modules\Calculator\Models\Computations\Addition;
use Modules\Calculator\Models\Computations\Divide;
use Modules\Calculator\Models\Computations\Exponentiation;
use Modules\Calculator\Models\Computations\Multiply;
use Modules\Calculator\Models\Computations\SinCosTan;
use Modules\Calculator\Models\Computations\Subtraction;
use Modules\Calculator\Models\HistoryModel;
use Modules\Calculator\Views\CalculatorView;
use Modules\Calculator\Views\HistoryView;
use Psr\Log\LoggerInterface;

return [
    IHistoryModel::class => function () {
        return new HistoryModel();
    },
    ICalculatorController::class => function (Container $container) {
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $historyModel = $container->get(IHistoryModel::class);
        return new CalculatorController($redirectHandler, $logger, $configManager, $container, $historyModel,);
    },
    IHistoryController::class => function (Container $container) {
        $redirectHandler = $container->get(IWebRedirectHandler::class);
        $logger = $container->get(LoggerInterface::class);
        $configManager = $container->get(IWebConfigManager::class);
        $historyView = $container->get(IHistoryView::class);
        $historyModel = $container->get(IHistoryModel::class);
        return new HistoryController($redirectHandler, $logger, $configManager, $historyView, $historyModel,);
    },
    IHistoryView::class => function ($container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new HistoryView($templateEngine);
    },
    ICalculatorView::class => function ($container) {
        $templateEngine = $container->get(IWebTemplateEngine::class);
        return new CalculatorView($templateEngine);
    },
    IAddition::class => function ($container) {
        $logger = $container->get(LoggerInterface::class);
        return new Addition($logger);
    },
    ISubtraction::class => function ($container) {
        $logger = $container->get(LoggerInterface::class);
        return new Subtraction($logger);
    },
    IMultiply::class => function ($container) {
        $logger = $container->get(LoggerInterface::class);
        return new Multiply($logger);
    },
    IDivide::class => function ($container) {
        $logger = $container->get(LoggerInterface::class);
        return new Divide($logger);
    },
    IExponentiation::class => function ($container) {
        $logger = $container->get(LoggerInterface::class);
        return new Exponentiation($logger);
    },
    ISinCosTan::class => function ($container) {
        $logger = $container->get(LoggerInterface::class);
        return new SinCosTan($logger);
    },
];
