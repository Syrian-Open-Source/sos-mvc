<?php


namespace app\controllers;


use app\core\Application;

class AboutController
{

    public function index()
    {
        return Application::$instance->router->renderView('about');
    }
}
