<?php

namespace app\core;


use app\controllers\BaseController;

/**
 * Class Application
 *
 * @author karam mustafa
 * @package app\core
 */
class Application
{

    /**
     * router property
     *
     * @author karam mustafa
     * @var string
     */
    public static string $ROOT_DIR;

    /**
     * instance of application class
     *
     * @author karam mustafa
     * @var \app\core\Application
     */
    public static Application $instance;

    /**
     * instance of route class
     *
     * @author karam mustafa
     * @var \app\core\Router
     */
    public Router $router;

    /**
     * instance of request class
     *
     * @author karam mustafa
     * @var \app\core\Request
     */
    private Request $request;

    /**
     * instance of response class
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    private Response $response;

    /**
     * instance of base controller class
     *
     * @author karam mustafa
     * @var \app\controllers\BaseController
     */
    public BaseController $controller;

    /**
     * @return \app\controllers\BaseController
     * @author karam mustaf
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param  \app\controllers\BaseController  $controller
     *
     * @author karam mustaf
     */
    public function setController(BaseController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Application constructor.
     *
     * @param  string  $rootDir
     */
    public function __construct(string $rootDir)
    {
        static::$ROOT_DIR = $rootDir;
        self::$instance = $this;
        self::$instance = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * main run function
     *
     * @return mixed|string
     * @author karam mustafa
     */
    public function run()
    {
        return $this->router->resolve();
    }

}
