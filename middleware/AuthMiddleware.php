<?php


namespace app\middleware;


use app\core\Contracts\Middleware;
use app\core\Exceptions\ForbiddenException;

/**
 * Class AuthMiddleware
 *
 * @author karam mustafa
 * @package app\middleware
 */
class AuthMiddleware implements Middleware
{

    /**
     *
     * @author karam mustafa
     * @var array
     */
    public array $actions;

    /**
     * AuthMiddleware constructor.
     *
     * @param $actions
     */
    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * @inheritDoc
     * @throws \app\core\Exceptions\ForbiddenException
     */
    public function execute()
    {
        if (!auth()->check() && !in_array(controller()->action, $this->actions)) {

            throw new ForbiddenException();
        }
    }
}
