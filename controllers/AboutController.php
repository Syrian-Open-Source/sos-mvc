<?php


namespace app\controllers;



/**
 * Class AboutController
 *
 * @author karam mustafa
 * @package app\controllers
 */
class AboutController extends BaseController
{

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    public function index()
    {
        return $this->render('about');
    }
}
