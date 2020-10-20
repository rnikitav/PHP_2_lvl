<?php


namespace App\controllers;


use App\entities\Entity;
use App\services\PaginatorService;

class LkController extends Controller
{
    protected $actionDefault = 'all';


    public function allAction()
    {
        if ($this->isAdmin){
            return $this->adminRender();
        }
        if (!key_exists('login' , $_SESSION['user'])){
            return header("Location: /");
        }
        $loginUser = $this->request->getSession('user')->login;
        $paginator = new PaginatorService($this->app->orderRepository, '/lk/');
        $paginator->setItemsOrder($loginUser ,$this->getPage());
        $goods = $paginator->getItems();
        $arr = [];
        foreach ($goods as $key => $one){
            $arr[$key]['time'] = $one->time;
            $arr[$key]['address'] = $one->address;
            $arr[$key]['status'] = $one->status;
            $arr[$key]['goods'] = json_decode($one->goods, true);
        }
        return $this->render('order',
            [
                'orders' =>  $arr,
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);
    }

    private function adminRender(){
        $paginator = new PaginatorService($this->app->orderRepository, '/lk/');
        $paginator->setItems();
        $goods = $paginator->getItems();
        return $this->render('adminorder',
            [
                'orders' =>  $goods,
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);
    }

    public function changeStatusAction()
    {
        if (!$this->isAdmin){
            return header('Location: /');
        }
        return $this->statusChange();
    }

    private function statusChange()
    {
        $str = explode('&id=', $this->request->getParamsName());
        $id = (int)$str[1];
        $status = $_POST['status'];
        $res = $this->app->orderRepository->getOne($id);
        $res->status = $status;
        $this->app->orderRepository->save($res);
        return header('Location: /lk/');
    }


    public function exitAction()
    {
        session_destroy();
        session_start();
        header('Location: /');
    }

}
