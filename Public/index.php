<?php

use Engine\DTO\ConfigDTO;

require_once('../vendor/autoload.php');
$configDTO = new ConfigDTO(require_once('../Config/app.php'));

require_once ("../Config/containerConfig.php");

/** @var $container */
$app = $container->get('Application');
$app->run();
