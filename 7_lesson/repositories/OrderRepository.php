<?php


namespace App\repositories;

use App\entities\Order;
class OrderRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return 'orders';
    }

    public function getEntityName(): string
    {
        return Order::class;
    }
}
