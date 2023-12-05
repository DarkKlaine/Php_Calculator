<?php

namespace Engine\Controllers;

use Engine\Services\Routers\WebRouter\WebRequestDTO;

interface IEngineControllerWeb
{
    public function engineHomePage(WebRequestDTO $request): void;
}
