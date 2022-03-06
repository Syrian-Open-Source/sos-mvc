<?php


namespace app\core;


class Session
{
    /**
     *
     */
    protected const flashKey = 'flash_messaged';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $messages = $_SESSION[self::flashKey];

        foreach ($messages as $key => $message){

        }
    }

    /**
     * description
     *
     * @param $key
     * @param $message
     *
     * @author karam mustafa
     */
    public function setFlash($key, $message)
    {
        $_SESSION[self::flashKey][$key] = $message;
    }

    /**
     * description
     *
     * @author karam mustafa
     */
    public function getFlash()
    {

    }
}
