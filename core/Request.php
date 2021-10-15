<?php


namespace app\core;


class Request
{
    /**
     * this will contains all config for custom request method type.
     *
     * @author karam mustafa
     * @var array
     */
    private  $availableMethods = [
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
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * check if request is post
     *
     * @return boolean
     * @author karam mustafa
     */
    public function isPost()
    {
        return $this->method() == 'post';
    }

    /**
     * check if request is post
     *
     * @return boolean
     * @author karam mustafa
     */
    public function isGet()
    {
        return $this->method() == 'get';
    }

    /**
     * get the body of get request, this will filter the inputs and return the secure body.
     *
     * @return array
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
     * @return array
     * @author karam mustafa
     */
    private function resolveMethodType()
    {
        $type = $_GET;

        if ($this->method() == 'post') {
            $type = $_POST;
        }

        return [$type, $this->availableMethods[$this->method()][0]];

    }

    /**
     * description
     *
     * @return array
     * @author karam mustafa
     */
    public function all()
    {
        return $this->getBody();
    }
}
