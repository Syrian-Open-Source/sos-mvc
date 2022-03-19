<?php

use app\core\Application;
use app\core\Config;

require_once __DIR__.'./vendor/autoload.php';


$app = new Application(basename(__DIR__) , (new Config())->getEnv());

app()->on('BEFORE_ROUTE_IMPLEMENTED', function (){
    echo 'Yes, the events are work !!';
});

$app->run();
