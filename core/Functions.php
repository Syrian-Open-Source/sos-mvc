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
