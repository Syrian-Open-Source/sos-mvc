<?php


namespace app\core;


class Session
{
    /**
     *
     */
    protected const flashKey = 'flash_messages';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $messages = $_SESSION[self::flashKey] ?? [];

        foreach ($messages as $key => &$message) {
            $message['to_removed'] = true;
        }

        $_SESSION[self::flashKey] = $messages;
    }

    /**
     * description
     *
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return \app\core\Session
     * @author karam mustafa
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;

        return $this;
    }

    /**
     * remove session value by specific key.
     *
     * @param  string  $key
     *
     * @return void
     * @author karam mustafa
     */
    public function remove($key)
    {
       if (isset($_SESSION[$key])){
           unset($_SESSION[$key]);
       }
    }

    /**
     * get session value by specific key.
     *
     * @param $key
     *
     * @return mixed
     * @author karam mustafa
     */
    public function get($key)
    {
        return $_SESSION[$key] ?? false;

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
        $_SESSION[self::flashKey][$key] = [
            'to_removed' => false,
            'value' => $message,
        ];
    }

    /**
     * description
     *
     * @param  string  $key
     *
     * @return bool
     * @author karam mustafa
     */
    public function getFlash(string $key)
    {
        if (!isset($_SESSION[self::flashKey][$key])) {
            return false;
        }

        return $_SESSION[self::flashKey][$key]['value'];
    }

    /**
     * class destructor
     */
    public function __destruct()
    {
        $messages = $_SESSION[self::flashKey];

        foreach ($messages as $key => &$message) {
            if ($message['to_removed']) {
                unset($messages[$key]);
            }
        }

        $_SESSION[self::flashKey] = $messages;
    }
}
