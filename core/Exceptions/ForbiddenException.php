<?php


namespace app\core\Exceptions;


/**
 * Class ForbiddenException
 *
 * @author karam mustafa
 * @package app\core\Exceptions
 */
class ForbiddenException extends \Exception
{

    /**
     *
     * @author karam mustafa
     * @var int
     */
    protected $code = 403;
    /**
     *
     * @author karam mustafa
     * @var string
     */
    protected $message = "you don't have a permission to access this page";


}
