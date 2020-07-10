<?php


namespace App\models;


class Order extends Model
{
	public $time;
	public $address;
	public $buyer;
	public $goods;
	public $status;



	/**
	 * @inheritDoc
	 */
	public function getNameTable(): string
	{
		return 'orders';
	}
}
