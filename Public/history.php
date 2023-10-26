<?php

use App\Controllers\Run;

require_once('../vendor/autoload.php');

$run = new Run();
$run->runHistory();
