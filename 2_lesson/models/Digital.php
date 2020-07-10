<?php


namespace App\models;


class Digital extends Product
{
	public $price;
	public $name;
	public $totalPrice;



	protected function Price() {
		$this->totalPrice = $this->price / 2;
		return $this->totalPrice;
	}

}
