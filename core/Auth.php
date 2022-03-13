<?php


namespace app\core;


use app\core\Contracts\Authenticatable;

class Auth implements Authenticatable
{


    public function login($user): bool
    {
        app()->session->set('user' , $user->id);
        return true;

    }

    public function logout($user): bool
    {

        return false;
    }
}
