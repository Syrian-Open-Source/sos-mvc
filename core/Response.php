<?php


namespace app\core;


/**
 * Class Response
 *
 * @author karam mustafa
 * @package app\core
 */
class Response
{


    /**
     * set status code in response.
     *
     * @param  int  $code
     *
     * @author karam mustafa
     */
    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    /**
     *
     *
     * @param  string  $rul
     *
     * @author karam mustafa
     */
    public function redirect(string $rul)
    {
        return header("Location: $rul");
    }
}
