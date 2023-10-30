<?php

use App\Application;

session_start();

require_once('../vendor/autoload.php');
$appConfig = require_once('../Config/app.php');

$app = new Application($appConfig);
$app->run();
