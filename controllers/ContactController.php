<?php


namespace app\controllers;


use app\core\Application;

class ContactController extends BaseController
{

    public function index()
    {
        $params = [
            'title' => 'test from request',
        ];
        return $this->render('contact', $params);
    }

    public function store()
    {
        echo 'its request';
        exit;
    }
}
