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
    public Router $router;

    /**
     * instance of request class
     *
     * @author karam mustafa
     * @var \app\core\Request
     */
    public Request $request;

    /**
     * instance of response class
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    public Response $response;

    /**
     * instance of base controller class
     *
     * @author karam mustafa
     * @var \app\controllers\BaseController
     */
    public BaseController $controller;

    /**
     * instance of database class
     *
     * @author karam mustafa
     * @var \app\core\Database
     */
    public Database $db;
    /**
     *
     * @author karam mustafa
     * @var \app\core\Session
     */
    public Session $session;
    /**
     *
     * @author karam mustafa
     * @var \app\core\View
     */
    public View $view;
    /**
     *
     * @author karam mustafa
     * @var \app\core\Events
     */
    public Events $events;

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
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->view = new View();
        $this->events = new Events();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
    }

    /**
     * main run function
     *
     * @return mixed|string
     * @throws \Exception
     * @author karam mustafa
     */
    public function run()
    {
        try {
            return $this->router->resolve();
        } catch (\Exception $e) {
            return $this->view->renderView('error', [
                'message' => $e->getMessage()
            ]);
        }
    }
    /**
     * description
     *
     * @param $event
     * @param $callback
     *
     * @return \app\core\Application
     * @author karam mustafa
     */
    public function on($event, $callback)
    {
        $this->events = $this->events->on($event, $callback);

        return $this;
    }
}
