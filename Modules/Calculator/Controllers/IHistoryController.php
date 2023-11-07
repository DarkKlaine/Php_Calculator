<?php

namespace Modules\Calculator\Controllers;

interface IHistoryController
{
    public function showGeneral(): void;

    public function showPersonal(): void;
}