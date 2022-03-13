<?php


namespace app\middleware;


use app\core\Contracts\Middleware;

class AuthMiddleware implements Middleware
{

    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (!auth()->check() && !in_array(request()->controller->actions, $this->actions)){


        }
    }
}
