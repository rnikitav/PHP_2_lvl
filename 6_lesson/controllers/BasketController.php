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
        $basketServ = new BasketService();
        $res = $basketServ->show($this->request);
        $sum = $basketServ->subTotal($res);
        return $this->render('basket',
            [
                'data' => $res,
                'isSignIn' => $this->request->isSingIn(),
                'sum' => $sum,
            ]);
    }

    public function addAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        if(empty($id)){
            return $this->setError('Не передан id');
        }
        if(empty($article)){
            return $this->setError('Не передан артикул');
        }
        (new BasketService())->add($id, $this->request, $article);
        $this->request->redirect();
    }

    public function delAction()
    {
        $article = $this->getArticle();
        (new BasketService())->del( $this->request, $article);
        $this->request->redirect();
    }
    public function removeAction()
    {
        $sessionKey = 'goods';
        $article = $this->getArticle();
        (new BasketService())->removeFromCart( $this->request, $article, $sessionKey);
        $this->request->redirect();

    }

    public function clearCartAction(){
        (new BasketService())->clearCart( $this->request, 'goods');
        $this->request->redirect();
    }
    protected function setError($msg)
    {
        return $this->render('errorpage',
            [
                'msg' => $msg
            ]);
    }
}
