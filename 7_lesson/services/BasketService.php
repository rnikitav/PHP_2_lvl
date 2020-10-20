<?php


namespace App\services;


use App\entities\Basket;
use App\repositories\BasketRepository;


class  BasketService extends Service

{
    public function show(Request $request)
    {
        return $request->getSession('goods');
    }

    public function add($id, Request $request, $article)
    {

        $goodForBasket = new Basket();

        if (!empty($getSession = $request->getSession('goods', $article))){
            $getSession->count++;
            return $_SESSION['goods'];
        }
//        $res = (new BasketRepository())->getOne($id);
        $res = $this->container->basketRepository->getOne($id);

        foreach ($goodForBasket as $key =>  $value){
            $goodForBasket->$key = $res->$key;
        }
        $goodForBasket->count = 1;
        $request->setSession('goods' , $article, $goodForBasket);
//        $_SESSION['goods'][$article] = $goodForBasket;

        return $request->getSession('goods');
    }

    public function del( Request $request, $article)
    {
        $data = $request->getSession('goods', $article);
        if ($data->count == 1){
            $this->removeFromCart($request, $article, 'goods');
            return;
        }
        $data->count--;
    }
    public function removeFromCart( Request $request, $article, $sessionKey = '')
    {
        $request->clearSession($sessionKey ,$article);
    }

    public function clearCart(Request $request, $sessionKey = '')
    {
        $request->clearSession($sessionKey);
    }

    public function subTotal($goods)
    {
        $sum = 0;
        if (!empty($goods)){
            foreach ($goods as $one){
                $sum += $one->price * $one->count;
            }
        }
        return $sum;
    }

    private function sumPrivate($a, $b)
    {
        return $a + $b;
    }

