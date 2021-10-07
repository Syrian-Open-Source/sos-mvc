<?php


namespace app\controllers;


use app\core\Application;
use app\core\Request;

class ContactController extends BaseController
{

    public function index()
    {
        $params = [
            'title' => 'test from request',
        ];
        return $this->render('contact', $params);
    }

    public function store(Request $request)
    {
        $this->setLayout('auth');
        var_dump(Application::$instance->controller->layout);
        echo 'its request';
        exit;
    }
}
