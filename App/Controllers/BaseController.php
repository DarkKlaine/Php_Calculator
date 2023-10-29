<?php

namespace App\Controllers;

use App\DTO\Request;

abstract class BaseController
{
    abstract public function run(Request $request): void;

}