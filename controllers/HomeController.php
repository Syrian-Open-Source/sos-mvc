<?php


namespace app\controllers;


use app\core\Application;

/**
 * Class HomeController
 *
 * @author karam mustafa
 * @package app\controllers
 */
class HomeController extends BaseController
{

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    public function index()
    {
        return $this->render('home');
    }
}
