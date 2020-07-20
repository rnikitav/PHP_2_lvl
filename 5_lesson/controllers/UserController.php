<?php

namespace App\controllers;

use App\models\Good;
use App\models\User;
use App\services\PaginatorService;
use App\traits\Tshop;

class UserController extends Controller
{
    protected $actionDefault = 'index';



    public function indexAction()
    {
        return $this->render('home');
    }

    public function allAction()
    {
        $paginator = new PaginatorService('?c=user&a=all');
        $user = new User();
        $paginator->setItems($user, $this->getPage());
        return $this->render('users',
            [
                'users' =>  $paginator
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
