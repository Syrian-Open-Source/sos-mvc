<?php


namespace app\controllers;


use app\core\Application;
use app\core\Request;
use app\models\User;

/**
 * Class AuthController
 *
 * @author karam mustafa
 * @package app\controllers
 */
class AuthController extends BaseController
{

    /**
     * description
     *
     * @param  \app\core\Request  $request
     *
     * @author karam mustafa
     */
    public function login(Request $request)
    {
        $this->setLayout('auth');
        $this->render('login');
    }

    /**
     * description
     *
     * @param  \app\core\Request  $request
     *
     * @return string|void
     * @author karam mustafa
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->load($request->all());
        if ($request->isPost()) {
            if ($user->validate()) {

                $user->name = $request->getAttribute('name');
                $user->password = $request->getAttribute('name');
                $user->save();
                Application::$instance->session->setFlash('success', 'your register was success');
                return Application::$instance->response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }
}
