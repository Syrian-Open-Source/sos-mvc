<?php


function dd(...$params)
{
    echo '<pre>';
    var_dump(...$params);
    echo '</pre>';
    exit;
}
