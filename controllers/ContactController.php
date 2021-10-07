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
        echo 'its request';
        exit;
    }
}
