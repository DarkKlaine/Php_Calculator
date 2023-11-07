<?php

namespace Modules\Calculator;

interface IHistoryController
{
    public function showGeneral(): void;

    public function showPersonal(): void;
}