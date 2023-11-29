<?php

namespace Modules\Calculator\Controllers\WebControllers;

interface IWebHistoryController
{
    public function showGeneral(): void;

    public function showPersonal(): void;
    public function showDB(): void;
}