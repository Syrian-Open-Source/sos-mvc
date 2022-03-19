<?php


namespace app\core;


use app\core\Contracts\Authenticatable;
use app\models\User;

/**
 * Class Auth
 *
 * @author karam mustafa
 * @package app\core
 */
class Auth implements Authenticatable
{


    /**
     * login new user
     *
     * @param $user
     *
     * @return bool
     * @author karam mustafa
     */
    public function login($user): bool
    {
        app()->session->set('user', $user->id);
        app()->session->set('userName', $user->name);

        return true;

    }

    /**
     * logout authenticated user.
     *
     * @param $user
     *
     * @return bool
     * @author karam mustafa
     */
    public function logout($user): bool
    {
        app()->session->set('user', null)->remove('user');

        return true;
    }

    /**
     * get authenticated user
     *
     * @return \app\core\DbModel
     * @author karam mustafa
     */
    public function user()
    {
        return (new User)->find(['id' => app()->session->get('id')]);
    }


    /**
     * check if user authenticated
     *
     * @return bool
     * @author karam mustafa
     */
    public function check(): bool
    {
        return app()->session->get('user');
    }
}
