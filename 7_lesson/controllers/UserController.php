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
        return $this->app->renderer->render('home',
            [
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);
    }

    public function allAction()
    {
        $paginator = new PaginatorService($this->app->userRepository, '/user/all');
        $paginator->setItems($this->getPage());
        return $this->render('users',
            [
                'users' =>  $paginator,
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);
    }
    public function oneAction()
    {
        $id = $this->getId();
        $res = $this->app->userRepository->getOne($id);
        if ($res){
            return $this->render('user',
                [
                    'user' =>  $res,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
        return $this->render('errorpage',
            [
                'msg' => 'Пользователь с таким id не найден',
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);

    }

}
