<?php


namespace App\controllers;


use App\services\RegistrationService;

class RegistrationController extends Controller
{
    protected $actionDefault = 'index';

    public function indexAction()
    {
        $msg = '';
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->app->renderer->render('registration',
                [
                    'msg' => $msg,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
        $arrFromPost = $this->request->post();
        foreach ($arrFromPost as $key => $value){
            $arrFromPost[$key] = $this->request->prepareString($value);
        }
        $error = $this->app->registrationService->register($arrFromPost);
        if ($error){
            return $this->app->renderer->render('registration',
                [
                    'data' => $arrFromPost,
                    'msg' => $error,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
    }
}
