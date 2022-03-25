<?php

use app\core\Application;
use app\core\Config;
use app\core\Runner;

require_once __DIR__.'./vendor/autoload.php';


$app = new Application(basename(__DIR__) , (new Config())->getEnv());
$runner = (new Runner($app))->resolveCommand($argv[1]);

