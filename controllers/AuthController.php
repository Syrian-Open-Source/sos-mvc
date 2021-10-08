<?php


namespace app\controllers;


use app\core\Request;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        $this->setLayout('auth');
        $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            dd($request->all());
        }
        $this->setLayout('auth');
        $this->render('register');
    }
}
