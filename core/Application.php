<?php

namespace app\core;


use app\controllers\BaseController;
use app\controllers\Session;

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
    public static $ROOT_DIR;

    /**
     * instance of application class
     *
     * @author karam mustafa
     * @var \app\core\Application
     */
    public static $instance;

    /**
     * instance of route class
     *
     * @author karam mustafa
     * @var \app\core\Router
     */
    public $router;

    /**
     * instance of request class
     *
     * @author karam mustafa
     * @var \app\core\Request
     */
    private $request;

    /**
     * instance of response class
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    public $response;

    /**
     * instance of base controller class
     *
     * @author karam mustafa
     * @var \app\controllers\BaseController
     */
    public $controller;

    /**
     * instance of database class
     *
     * @author karam mustafa
     * @var \app\core\Database
     */
    public $db;
    /**
     *
     * @author karam mustafa
     * @var \app\controllers\Session
     */
    public Session $session;

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
     * @param $config
     */
    public function __construct($rootDir, $config)
    {
        static::$ROOT_DIR = $rootDir;
        self::$instance = $this;
        self::$instance = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
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
