<?php


namespace app\controllers;


use app\core\Application;

class BaseController
{
    
    public $layout = 'main';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render(...$params)
    {
        return Application::$instance->router->renderView(...$params);
    }
}
