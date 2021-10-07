<?php


namespace app\controllers;


use app\core\Application;

class AboutController extends BaseController
{

    public function index()
    {
        return $this->render('about');
    }
}
