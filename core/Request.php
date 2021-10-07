<?php


namespace app\core;


class Request
{

    private $availableMethods = [
        'get' => [INPUT_GET],
        'post' => [INPUT_POST],
    ];


    /**
     * get the request path without query params.
     *
     * @return false|mixed|string
     * @author karam mustafa
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        $position = strpos($path, '?');

        return $position
            ? substr($path, 0, $position)
            : $path;
    }

    /**
     * get the method name.
     *
     * @return string
     * @author karam mustafa
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * get the body of get request, this will filter the inputs and return the secure body.
     *
     * @return false|mixed|string
     * @author karam mustafa
     */
    public function getBody()
    {
        $body = [];
        $request = $this->resolveMethodType();
        foreach ($request[0] as $key => $value) {
            $body[$key] = filter_input($request[1], $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    /**
     * this will match the method of request, and get the variable to make the process dynamic.
     *
     * @return false|mixed|string
     * @author karam mustafa
     */
    private function resolveMethodType()
    {
        $type = $_GET;

        if ($this->getMethod() == 'post') {
            $type = $_POST;
        }

        return [$type, $this->availableMethods[$this->getMethod()][0]];

    }
}
