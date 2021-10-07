<?php


namespace app\controllers;


use app\core\Application;

class ContactController
{

    public function index()
    {
        $params = [
            'title' => 'test from request',
        ];
        return Application::$instance->router->renderView('contact' ,$params);
    }

    public function store()
    {
        echo 'its request';
        exit;
    }
}
