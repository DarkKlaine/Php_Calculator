<?php

namespace App\Controllers;

abstract class BaseController
{
    abstract public function run(object $serverGlobalDTO): void;

}