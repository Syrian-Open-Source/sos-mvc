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
     * description
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
     * description
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
     * description
     *
     * @return \app\core\DbModel
     * @author karam mustafa
     */
    public function user(): ?DbModel
    {
        return (new User)->find(['id' => app()->session->get('id')]) ?? [];
    }


    /**
     * description
     *
     * @return bool
     * @author karam mustafa
     */
    public function check(): bool
    {
        return !empty($this->user());
    }
}
