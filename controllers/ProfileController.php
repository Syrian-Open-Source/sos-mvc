<?php


namespace app\controllers;


use app\core\Response;
use app\middleware\AuthMiddleware;

class ProfileController extends BaseController
{
    /**
     *
     * @author karam mustafa
     * @var \app\core\Session
     */
    private $session;
    /**
     *
     * @author karam mustafa
     * @var \app\core\Response
     */
    private Response $response;

    public function __construct()
    {
        $this->session = app()->session;
        $this->response = app()->response;
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function profile(){
        $this->render('profile');
    }
}
