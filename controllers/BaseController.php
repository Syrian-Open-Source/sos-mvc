<?php


namespace app\controllers;


use app\core\Application;

class BaseController
{


    public function render(...$params)
    {
        return Application::$instance->router->renderView(...$params);
    }
}
