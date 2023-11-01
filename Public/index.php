<?php

use App\Application;
use App\DTO\ConfigDTO;

session_start();

require_once('../vendor/autoload.php');
new ConfigDTO(require_once('../Config/app.php'));

$app = new Application();
$app->run();
