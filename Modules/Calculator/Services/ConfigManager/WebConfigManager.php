<?php

namespace Modules\Calculator\Services\ConfigManager;

use Engine\Services\ConfigManagers\WebBaseConfigManager;

class WebConfigManager extends WebBaseConfigManager
{
    private string $moduleUrl;

    public function __construct($appConfig)
    {
        parent::__construct($appConfig);
        $this->moduleUrl = '';
    }

    public function getModuleUrl(): string
    {
        return $this->moduleUrl;
    }
}
