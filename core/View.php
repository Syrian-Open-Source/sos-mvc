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
            $layoutContent = $this->renderContent();

            $viewContent = $this->renderOnlyView("$viewName", $params);

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

}
