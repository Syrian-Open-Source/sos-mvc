<?php


namespace app\controllers;


use app\core\Request;
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

    public function contact(Request $request)
    {

        $model = new ContactForm();
        if ($request->isPost()){
            dd(1);
        }
        return $this->render('contact' , [
            'model' => $model
        ]);
    }
}
