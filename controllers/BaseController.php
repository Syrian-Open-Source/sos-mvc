<?php


namespace app\controllers;


use app\core\Application;
use app\core\Contracts\Middleware;

class BaseController
{

    /**
     *
     * @author karam mustafa
     * @var string
     */
    public $layout = 'main';
    /**
     *
     * @author karam mustafa
     * @var Middleware[]
     */
    private array $middleware;

    /**
     * description
     *
     * @param $layout
     *
     * @author karam mustafa
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * description
     *
     * @param  mixed  ...$params
     *
     * @return string
     * @author karam mustafa
     */
    public function render(...$params)
    {
        return Application::$instance->view->renderView(...$params);
    }

    public function registerMiddleware(?Middleware $middleware)
    {
        $this->middleware[] = $middleware;
    }

    /**
     * @return array
     * @author karam mustafa
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

}
