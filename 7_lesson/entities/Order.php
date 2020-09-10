<?php


namespace App\entities;


class Order extends Entity
{
    public $id;
    public $time;
    public $address;
    public $buyer;
    public $goods;
    public $status;

}
