<?php

use app\core\Application;

require_once __DIR__.'./vendor/autoload.php';

$app = new Application(basename(__DIR__));

$app->router->get('/home', 'home');
$app->router->post('/about', 'about');

$app->run();
