<?php

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\AboutController;
use app\controllers\ContactController;
use app\controllers\ProfileController;


route()->on('BEFORE_ROUTE_IMPLEMENTED', function (){
    echo 'Yes, the events are work !!';
});

route()->get('/home', [HomeController::class, 'index']);
route()->get('/about', [AboutController::class, 'index']);
route()->get('/contact', [ContactController::class, 'index']);
route()->post('/contact', [ContactController::class, 'store']);

route()->get('/login', [AuthController::class, 'login']);
route()->post('/login', [AuthController::class, 'login']);
route()->get('/register', [AuthController::class, 'register']);
route()->post('/register', [AuthController::class, 'register']);
route()->get('/logout', [AuthController::class, 'logout']);
route()->get('/profile', [ProfileController::class, 'profile']);
route()->get('/contact', [HomeController::class, 'contact']);
route()->post('/contact', [HomeController::class, 'contact']);

