<?php

namespace app\core;

use app\controllers\BaseController;
use app\core\Contracts\Middleware;

/**
 * Class Router
 *
 * @author karam mustafa
 */
class Router
{

    /**
     * routes array
     *
     * @author karam mustafa
     * @var \app\core\Request
     */
    protected $routes = [];
    /**
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    protected Response $response;
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
     * @var \app\core\View
     */
    private View $view;

    /**
     * Router constructor.
     *
     * @param  \app\core\Request  $request
     * @param  \app\core\Response  $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->view = Application::$instance->view;
        $this->events = Application::$instance->events;
    }

    /**
     * set get request type.
     *
     * @param  string  $path
     * @param  mixed  $callback
     *
     * @return \app\core\Router
     * @author karam mustafa
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
        return $this;

    }

    /**
     * set post request type.
     *
     * @param  string  $path
     * @param  mixed  $callback
     *
     * @return \app\core\Router
     * @author karam mustafa
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;

        return $this;
    }

    /**
     * description
     *
     * @return mixed|string
     * @throws \Exception
     * @author karam mustafa
     */
    public function resolve()
    {
        $this->loadRouteFrom(__DIR__."./../routes/web.php");

        $path = $this->request->getPath();

        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;

        return $this->resolveRouteCallback($callback);

    }

    /**
     * description
     *
     * @param $callback
     *
     * @return mixed|string
     * @author karam mustafa
     */
    private function resolveRouteCallback($callback)
    {
        if (!$callback) {
            return $this->view->notFoundRoute();
        }

        if (is_string($callback)) {
            return $this->view->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$instance->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            $this->executeMiddleware();
        }

        return call_user_func($callback, $this->request);
    }


    /**
     * description
     *
     * @param  string  $path
     *
     * @return mixed
     * @throws \Exception
     * @author karam mustafa
     */
    private function loadRouteFrom(string $path)
    {
        if (file_exists($path)) {
            return include_once $path;
        }

        throw new \Exception("route file is not exist in path $path");
    }

    private function executeMiddleware()
    {
        foreach (Application::$instance->controller->getMiddleware() ?? [] as $middleware) {
            $middleware->execute();
        }
    }

    public function middleware(?Middleware $middleware)
    {
        if (!$middleware instanceof Middleware) {
            throw new \Exception("$middleware must be type of middleware");
        }
        Application::$instance->controller->registerMiddleware($middleware);

        return $this;
    }


}
