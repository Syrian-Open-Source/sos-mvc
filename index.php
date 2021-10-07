<?php

use app\core\Application;
use app\controllers\HomeController;
use app\controllers\AboutController;
use app\controllers\ContactController;

require_once __DIR__.'./vendor/autoload.php';

$app = new Application(basename(__DIR__));

$app->router->get('/home', [HomeController::class, 'index']);
$app->router->get('/about', [AboutController::class, 'index']);
$app->router->get('/contact', [ContactController::class, 'index']);
$app->router->post('/contact', [ContactController::class, 'store']);

$app->run();
