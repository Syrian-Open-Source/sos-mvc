<?php


namespace app\controllers;


use app\core\Auth;
use app\core\Model;
use app\core\Request;
use app\core\Response;
use app\middleware\AuthMiddleware;
use app\models\LoginForm;
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

        $this->registerMiddleware(new AuthMiddleware(['register']));

    }

    /**
     * description
     *
     * @param  \app\core\Request  $request
     *
     * @return string
     * @author karam mustafa
     */
    public function login(Request $request)
    {
        $model = new LoginForm();

        if ($request->isPost()) {
            $model->load($request->all());

            if ($model->validate() && $model->login()) {
                $this->response->redirect('/');
            }
        }

        $this->setLayout('auth');

        return $this->render('login', [
            'model' => $model
        ]);
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
                $this->session->setFlash('success', 'your register was success');
                return $this->response->redirect('/');
            }
        }
        $this->setLayout('auth');

        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout()
    {
        (new Auth())->logout(User::find(['id' => $this->session->get('user')]));

        return $this->response->redirect('/');
    }
}
