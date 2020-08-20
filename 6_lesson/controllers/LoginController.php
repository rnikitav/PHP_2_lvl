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
                    'msg' => $msg
                ]);
        }
        $arrFromPost = $this->request->post();
        $error = (new LoginService())->logIn($arrFromPost);
        if ($error){
            return $this->render('login',
                [
                    'data' => $arrFromPost,
                    'msg' => $error
                ]);
        }
    }
}
