<?php


function dd(...$params)
{
    echo '<pre>';
    var_dump(...$params);
    echo '</pre>';
    exit;
}


function env($key)
{
    return $_ENV[$key];
}
