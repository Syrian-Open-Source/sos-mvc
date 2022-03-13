<?php


namespace app\core;


use app\core\Contracts\Authenticatable;
use app\models\User;

class Auth implements Authenticatable
{


    public function login($user): bool
    {
        app()->session->set('user', $user->id);

        return true;

    }

    public function logout($user): bool
    {
        app()->session->set('user', null)->remove('user');

        return true;
    }

    public function user(): DbModel
    {
        return User::find(['id' => app()->session->get('id')]) ?? [];
    }
}
