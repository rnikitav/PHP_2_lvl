<?php


namespace App\controllers;


use App\services\LoginService;

class LoginController extends Controller
{
    protected $actionDefault = 'all';


    public function allAction()
    {
        $msg = '';
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->render('login',
                [
                    'msg' => $msg,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
        $arrFromPost = $this->request->post();

        $error = $this->app->loginService->logIn($arrFromPost);
        if ($error){
            return $this->app->renderer->render('login',
                [
                    'data' => $arrFromPost,
                    'msg' => $error,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
    }
}
