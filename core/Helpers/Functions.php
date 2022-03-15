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
if (!function_exists('request')) {

    function request()
    {
        return \app\core\Application::$instance->request;
    }

}

if (!function_exists('controller')) {

    function controller()
    {
        return \app\core\Application::$instance->controller;
    }

}
if (!function_exists('view')) {

    function view()
    {
        return \app\core\Application::$instance->view;
    }

}

