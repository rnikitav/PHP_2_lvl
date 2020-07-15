<?php

namespace App\controllers;

use App\models\Good;
use App\models\User;
use App\traits\Tshop;

class UserController
{
    private $action;
    protected $actionDefault = 'index';

    use TShop;


    public function indexAction()
    {
        return $this->render('home');
    }

    public function allAction()
    {
        return $this->render('users',
            [
                'users' =>  User::getAll()
            ]);
    }
    public function oneAction()
    {
        $id = $this->getId();
        return $this->render('user',
            [
                'user' =>  User::getOne($id)
            ]);

    }

}
