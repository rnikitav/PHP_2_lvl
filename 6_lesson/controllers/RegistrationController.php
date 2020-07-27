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
            return $this->render('registration',
                [
                    'msg' => $msg
                ]);
        }
        $arrFromPost = $this->request->post();
        foreach ($arrFromPost as $key => $value){
            $arrFromPost[$key] = $this->request->prepareString($value);
        }
        $error = (new RegistrationService())->register($arrFromPost);
        if ($error){
            return $this->render('registration',
                [
                    'data' => $arrFromPost,
                    'msg' => $error
                ]);
        }
    }
}
