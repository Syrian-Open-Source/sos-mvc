<?php


namespace app\controllers;


use app\models\ContactForm;

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

    public function contact()
    {
        $model = new ContactForm();
        return $this->render('contact' , [
            'model' => $model
        ]);
    }
}
