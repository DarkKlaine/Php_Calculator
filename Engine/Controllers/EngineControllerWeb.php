<?php

namespace Engine\Controllers;

use Engine\Views\EngineHomePageView;

class EngineControllerWeb implements IEngineControllerWeb
{
    private EngineHomePageView $engineHomePageView;

    public function __construct(EngineHomePageView $engineHomePageView,)
    {
        $this->engineHomePageView = $engineHomePageView;
    }

    public function engineHomePage(): void
    {
        $this->engineHomePageView->render();
    }
}
