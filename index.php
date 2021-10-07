<?php

use app\core\Application;
use app\controllers\HomeController;
use app\controllers\AboutController;
use app\controllers\ContactController;

require_once __DIR__.'./vendor/autoload.php';

$app = new Application(basename(__DIR__));

$app->router->get('/home', [new HomeController(), 'index']);
$app->router->get('/about', [new AboutController(), 'index']);
$app->router->get('/contact', [new ContactController(), 'index']);
$app->router->post('/contact', [new ContactController(), 'store']);

$app->run();
