<?php

use Engine\App\Application;
use Engine\App\DTO\ConfigDTO;

require_once('../vendor/autoload.php');
new ConfigDTO(require_once('../Config/app.php'));

$app = new Application();
$app->run();
