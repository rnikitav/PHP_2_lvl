<?php

namespace App\controllers;

use App\entities\User;
use App\repositories\UserRepository;
use App\services\PaginatorService;
use App\services\Request;

class UserController extends Controller
{
    protected $actionDefault = 'index';



    public function indexAction()
    {
        return $this->render('home');
    }

    public function allAction()
    {
        $paginator = new PaginatorService(new UserRepository(), '/user/all');
        $paginator->setItems($this->getPage());
        return $this->render('users',
            [
                'users' =>  $paginator
            ]);
    }
    public function oneAction()
    {
        $id = $this->getId();
        $res = (new UserRepository())->getOne($id);
        $isSingIn = $this->request->isSingIn();
        if ($res){
            return $this->render('user',
                [
                    'user' =>  $res,
                    'isSingIn' => $isSingIn
                ]);
        }
        return $this->render('errorpage',
            [
                'msg' => 'Пользователь с таким id не найден'
            ]);

    }

}
