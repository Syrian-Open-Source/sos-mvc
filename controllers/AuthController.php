<?php


namespace app\controllers;


use app\core\Request;
use app\models\RegisterModel;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        $this->setLayout('auth');
        $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        $registerModel->load($request->all());

        if ($request->isPost()) {
            if ($registerModel->validate() && $registerModel->register()) {
                echo 'success';
            }
        }

        $this->setLayout('auth');

        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}
