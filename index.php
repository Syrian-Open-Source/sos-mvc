<?php

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\HomeController;
use app\controllers\AboutController;
use app\controllers\ContactController;

require_once __DIR__.'./vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
  'db' => [
      'dsn' => $_ENV['DB_DSN'],
      'user' => $_ENV['DB_USERNAME'],
      'password' => $_ENV['DB_PASSWORD'],
  ]
];

$app = new Application(basename(__DIR__) , $config);

$app->run();
