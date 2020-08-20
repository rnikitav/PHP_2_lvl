<?php


namespace App\repositories;


use App\entities\Basket;

class BasketRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return 'goods';
    }

    public function getEntityName(): string
    {
        return Basket::class;
    }
}
