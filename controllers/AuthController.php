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
        $user = new User();
        $user->load($request->all());
        if ($request->isPost()) {
            if ($user->validate()) {
                $user->name = $request->getAttribute('name');
                $user->password = $request->getAttribute('name');
                $user->save();
            }
            echo 'success';

        }
//
        $this->setLayout('auth');

        return $this->render('register', [
            'model' => $user
        ]);
    }
}
