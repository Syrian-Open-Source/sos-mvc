<?php


namespace app\core\Contracts;


use app\core\DbModel;

interface Authenticatable
{

    public function login($user): bool;

    public function logout($user): bool;

    public function user(): DbModel;
}
