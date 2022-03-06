<?php


namespace app\controllers;


use app\core\Application;

class BaseController
{

    /**
     *
     * @author karam mustafa
     * @var string
     */
    public $layout = 'main';

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
        return Application::$instance->router->renderView(...$params);
    }
}
