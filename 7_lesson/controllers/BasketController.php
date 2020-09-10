<?php


namespace App\controllers;


use App\entities\Basket;
use App\services\BasketService;
use App\services\Request;

class BasketController extends Controller
{
    protected $actionDefault = 'all';

    public function allAction()
    {
        $basketServ = $this->app->basketService;
        $res = $basketServ->show($this->request);
        $sum = $basketServ->subTotal($res);
        return $this->app->renderer->render('basket',
            [
                'data' => $res,
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
                'sum' => $sum,
            ]);
    }

    public function addAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        if (empty($id)) {
            return $this->setError('Не передан id');
        }
        if (empty($article)) {
            return $this->setError('Не передан артикул');
        }
//        (new BasketService())->add($id, $this->request, $article);
        $this->app->basketService->add($id, $this->request, $article);
        $this->request->redirect();
    }

    public function addForBdAction()
    {
        $arrFromPost = $this->request->post();
        $address = '';
        foreach ($arrFromPost as $key => $value){
            if (empty($value)){
                return $this->render('errorpage',
                    [
                        'msg' => 'Не ввели адрес',
                        'isAdmin' => $this->isAdmin,
                        'isSignIn' => $this->isSingIn,
                    ]);
            }
            $address  .= $this->request->prepareString($value) . '/';
        }
        $res = $this->app->orderService->addToBd($this->request , $address);
        if ($res){
            unset($_SESSION['goods']);
            return $this->render('errorpage',
                [
                    'msg' => 'Ваш заказ успешно оформлен',
                    'isAdmin' => $this->isAdmin,
                    'isSignIn' => $this->isSingIn,
                ]);
        }
    }

    public function delAction()
    {

        $article = $this->getArticle();
        $this->app->basketService->del($this->request, $article);
        $this->request->redirect();
    }

    public function removeAction()
    {

        $sessionKey = 'goods';
        $article = $this->getArticle();
        $this->app->basketService->removeFromCart($this->request, $article, $sessionKey);
        $this->request->redirect();

    }

    public function clearCartAction()
    {
        $this->app->basketService->clearCart($this->request, 'goods');
        $this->request->redirect();
    }

    protected function setError($msg)
    {
        return $this->app->renderer->render('errorpage',
            [
                'msg' => $msg,
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);
    }
}
