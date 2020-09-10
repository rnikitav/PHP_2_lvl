<?php


namespace App\services;


use App\entities\Order;

class OrderService extends Service
{
    public function addToBd(Request $request ,$address = '')
    {
        if (empty($address)){
            return 'Не ввели адрес';
        }
        date_default_timezone_set('Europe/Moscow');
        $timestamp = time(); // зафиксировали время
        $date = date('Y/m/d - H:i', $timestamp);
        $buyer = $request->getSession('user', 'login');
        $orderGoods = json_encode($request->getSession('goods'));
        $goodForBd = new Order();
        $goodForBd->address = $address;
        $goodForBd->buyer = $buyer;
        $goodForBd->time = $date;
        $goodForBd->goods = $orderGoods;
        return $this->container->orderRepository->save($goodForBd);
    }
}
