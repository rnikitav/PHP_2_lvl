<?php


namespace App\models;


class Weigh extends Product
{

	protected $weigh;
	public $price;
	public $totalPrice;
	public function __construct($type ,$name, $price , $db , $weigh) {
		$this->weigh = $weigh;
		parent::__construct($type ,$name, $price , $db);
	}



	protected function Price() {
		$this->totalPrice = $this->price * $this->weigh;
		return $this->totalPrice;
	}


}
