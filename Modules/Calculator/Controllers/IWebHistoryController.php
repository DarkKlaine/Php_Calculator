<?php

namespace Modules\Calculator\Controllers;

interface IWebHistoryController
{
    public function showGeneral(): void;

    public function showPersonal(): void;
}