<?php


namespace app\core;


class View
{
    /**
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    protected Response $response;

    /**
     * View constructor.
     *
     */
    public function __construct()
    {
        $this->response = Application::$instance->response;
    }

    /**
     * description
     *
     * @param  string  $viewName
     *
     * @param  array  $params
     *
     * @return string
     * @author karam mustafa
     */
    public function renderView($viewName, $params = [])
    {
        if ($this->checkIsValidView($viewName)) {

            // load profile first will makes us able to load variable from child
            // into parent layout, so we can implement push something in the future.
            $viewContent = $this->renderOnlyView("$viewName", $params);

            $layoutContent = $this->renderContent();

            return print($this->renderTags($viewContent, $layoutContent));
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
    private function checkIsValidView($viewName)
    {
        return file_exists($this->formatViewFilePath("$viewName"));
    }

    /**
     * description
     *
     * @return false|string
     * @author karam mustafa
     */
    private function renderContent()
    {
        $layout = Application::$instance->controller->layout ?? 'main';
        ob_start();
        include_once $this->formatViewFilePath("layoutes/$layout");
        return ob_get_clean();
    }


    /**
     * description
     *
     * @param  string  $viewName
     *
     * @param  array  $params
     *
     * @return false|string
     * @author karam mustafa
     */
    private function renderOnlyView($viewName, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once $this->formatViewFilePath("$viewName");
        return ob_get_clean();
    }

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    public function notFoundRoute()
    {
        $this->response->setStatusCode(404);
        return $this->renderView($this->checkIfUserHaveNotFoundPage());
    }

    /**
     * description
     *
     * @param  string  $path
     *
     * @return string
     * @author karam mustafa
     */
    private function formatViewFilePath($path)
    {
        return __DIR__."./../views/$path.php";
    }

    private function checkIfUserHaveNotFoundPage()
    {
        $notFoundView = '404';
        if ($this->checkIsValidView($notFoundView)) {
            return $notFoundView;
        }

        //ToDO check if the framework has not found page internally
    }

    /**
     * description
     *
     * @param  string  $viewContent
     * @param  string  $layoutContent
     *
     * @return string|string[]
     * @author karam mustafa
     */
    private function renderTags(string $viewContent, string $layoutContent)
    {
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

}
