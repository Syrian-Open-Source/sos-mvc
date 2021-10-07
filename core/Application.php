<?php

namespace app\core;


/**
 * Class Application
 *
 * @author karam mustafa
 * @package app\core
 */
class Application
{

    public static string $ROOT_DIR;
    public static Application $instance;

    /**
     * router property
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
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    private Response $response;

    public function __construct(string $rootDir)
    {
        static::$ROOT_DIR = $rootDir;
        self::$instance = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        return $this->router->resolve();
    }

}
