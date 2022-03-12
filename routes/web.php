<?php

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\AboutController;
use app\controllers\ContactController;



route()->get('/home', [HomeController::class, 'index']);
route()->get('/about', [AboutController::class, 'index']);
route()->get('/contact', [ContactController::class, 'index']);
route()->post('/contact', [ContactController::class, 'store']);

route()->get('/login', [AuthController::class, 'login']);
route()->post('/login', [AuthController::class, 'login']);
route()->get('/register', [AuthController::class, 'register']);
route()->post('/register', [AuthController::class, 'register']);

