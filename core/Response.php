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
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
