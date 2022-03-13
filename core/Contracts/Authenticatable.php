<?php


namespace app\core\Contracts;


use app\core\DbModel;

/**
 * Interface Authenticatable
 *
 * @author karam mustafa
 * @package app\core\Contracts
 */
interface Authenticatable
{

    /**
     * description
     *
     * @param $user
     *
     * @return bool
     * @author karam mustafa
     */
    public function login($user): bool;

    /**
     * description
     *
     * @param $user
     *
     * @return bool
     * @author karam mustafa
     */
    public function logout($user): bool;

    /**
     * description
     *
     * @return \app\core\DbModel
     * @author karam mustafa
     */
    public function user(): DbModel;
}
