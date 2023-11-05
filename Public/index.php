<?php

use Engine\Application;
use Engine\DTO\ConfigDTO;

require_once('../vendor/autoload.php');
$configDTO = new ConfigDTO(require_once('../Config/app.php'));

require_once ("../Config/containerConfig.php");

/** @var $container */
$app = $container->get(Application::class);
$app->run();
