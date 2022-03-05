<?php


namespace app\controllers;


class Session
{
    protected const flashKey = 'flash_messaged';

    public function __construct()
    {
        session_start();
        $messages = $_SESSION[self::flashKey];

        foreach ($messages as $key => $message){

        }
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::flashKey][$key] = $message;
    }

    public function getFlash()
    {

    }
}
