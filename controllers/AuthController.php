<?php


namespace app\controllers;


use app\core\Request;
use app\models\User;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        $this->setLayout('auth');
        $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        $registerModel->load($request->all());
        if ($request->isPost()) {
            if ($registerModel->validate()) {
                $registerModel->name = $request->getAttribute('name');
                $registerModel->password = $request->getAttribute('name');
                $registerModel->save();
            }
        }
        echo 'success';
//
//        $this->setLayout('auth');
//
//        return $this->render('register', [
//            'model' => $registerModel
//        ]);
    }
}
