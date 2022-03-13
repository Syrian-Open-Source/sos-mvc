<?php


if (!function_exists('dd')) {
    function dd(...$params)
    {
        echo '<pre>';
        var_dump(...$params);
        echo '</pre>';
        exit;
    }

}

if (!function_exists('env')) {

    function env($key)
    {
        return $_ENV[$key];
    }

}

if (!function_exists('app')) {

    function app()
    {
        return \app\core\Application::$instance;
    }

}

if (!function_exists('auth')) {

    function auth()
    {
        return new \app\core\Auth();
    }

}
if (!function_exists('route')) {

    function route()
    {
        return \app\core\Application::$instance->router;
    }

}

