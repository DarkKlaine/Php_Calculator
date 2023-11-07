<?php

use Engine\Container\Container;
use Modules\Calculator\CalculatorController;
use Modules\Calculator\CalculatorView;
use Modules\Calculator\Computations\Addition;
use Modules\Calculator\Computations\Divide;
use Modules\Calculator\Computations\Exponentiation;
use Modules\Calculator\Computations\Multiply;
use Modules\Calculator\Computations\SinCosTan;
use Modules\Calculator\Computations\Subtraction;
use Modules\Calculator\HistoryController;
use Modules\Calculator\HistoryModel;
use Modules\Calculator\HistoryView;
use Modules\Calculator\IAddition;
use Modules\Calculator\ICalculatorController;
use Modules\Calculator\ICalculatorView;
use Modules\Calculator\IDivide;
use Modules\Calculator\IExponentiation;
use Modules\Calculator\IHistoryController;
use Modules\Calculator\IHistoryModel;
use Modules\Calculator\IHistoryView;
use Modules\Calculator\IMultiply;
use Modules\Calculator\ISinCosTan;
use Modules\Calculator\ISubtraction;

return [
    IHistoryModel::class => function () {
        return new HistoryModel();
    },
    ICalculatorController::class => function (Container $container) {
        return new CalculatorController($container);
    },
    IHistoryController::class => function (Container $container) {
        return new HistoryController($container);
    },
    IHistoryView::class => function ($container) {
        return new HistoryView($container);
    },
    ICalculatorView::class => function ($container) {
        return new CalculatorView($container);
    },
    IAddition::class => function ($container) {
        return new Addition($container);
    },
    ISubtraction::class => function ($container) {
        return new Subtraction($container);
    },
    IMultiply::class => function ($container) {
        return new Multiply($container);
    },
    IDivide::class => function ($container) {
        return new Divide($container);
    },
    IExponentiation::class => function ($container) {
        return new Exponentiation($container);
    },
    ISinCosTan::class => function ($container) {
        return new SinCosTan($container);
    },
];
