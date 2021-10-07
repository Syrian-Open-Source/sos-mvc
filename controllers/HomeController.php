<?php


namespace app\controllers;


use app\core\Application;

class HomeController extends BaseController
{

    public function index()
    {
        return $this->render('home');
    }
}
