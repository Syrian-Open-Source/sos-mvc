<?php

namespace app\core;

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
     * Router constructor.
     *
     * @param  \app\core\Request  $request
     * @param  \app\core\Response  $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * description
     *
     * @param  string  $path
     * @param  mixed  $callback
     *
     * @author karam mustafa
     */
    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * description
     *
     * @param  string  $path
     * @param  mixed  $callback
     *
     * @author karam mustafa
     */
    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * description
     *
     * @return mixed|string
     * @author karam mustafa
     */
    public function resolve()
    {
        $path = $this->request->getPath();

        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        return $this->resolveRouteCallback($callback);

    }

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    private function notFoundRoute()
    {
        $this->response->setStatusCode(404);
        return $this->renderView($this->checkIfUserHaveNotFoundPage());
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
            return $this->notFoundRoute();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    /**
     * description
     *
     * @param  string  $viewName
     *
     * @return string
     * @author karam mustafa
     */
    private function renderView(string $viewName)
    {
        if ($this->checkIsValidView($viewName)) {

            $layoutContent = $this->renderContent();

            $viewContent = $this->renderOnlyView("$viewName");

            return print(str_replace("{{content}}", $viewContent, $layoutContent));
        }

        return $this->notFoundRoute();
    }

    /**
     * description
     *
     * @param  string  $viewName
     *
     * @return bool
     * @author karam mustafa
     */
    private function checkIsValidView(string $viewName)
    {
        return file_exists($this->formatViewFilePath("$viewName"));
    }

    /**
     * description
     *
     * @param  string  $path
     *
     * @return string
     * @author karam mustafa
     */
    private function formatViewFilePath(string $path)
    {
        return __DIR__."./../views/$path.php";
    }

    /**
     * description
     *
     * @return false|string
     * @author karam mustafa
     */
    private function renderContent()
    {
        ob_start();
        include_once $this->formatViewFilePath("layoutes/main");
        return ob_get_clean();
    }

    /**
     * description
     *
     * @param  string  $viewName
     *
     * @return false|string
     * @author karam mustafa
     */
    private function renderOnlyView(string $viewName)
    {
        ob_start();
        include_once $this->formatViewFilePath("$viewName");
        return ob_get_clean();
    }

    private function checkIfUserHaveNotFoundPage()
    {
        $notFoundView = '404';
        if ($this->checkIsValidView($notFoundView)) {
            return $notFoundView;
        }

        //ToDO check if the framework has not found page internally
    }


}
