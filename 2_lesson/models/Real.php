<?php


namespace App\models;


class Real extends Product
{
	public $price;
	public $name;

	protected function Price() {
		return $this->price;
	}
}
