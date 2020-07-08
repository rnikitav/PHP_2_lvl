<?php


namespace App\models;


use App\services\IDB;

abstract class Product {

	protected $name;
	protected $price;
	protected $db;
	public $type;

	/**
	 * Product constructor.
	 *
	 * @param $type
	 * @param $name
	 * @param $price
	 * @param IDB $db
	 */
	public function __construct($type ,$name, $price , IDB $db) {
		$this->type = $type;
		$this->name = $name;
		$this->price = $price;
		$this->db = $db;
	}




	abstract protected function Price();

	public function MyPercent($percent){
		return $this->db->myMoney($this->Price(), $percent);
	}




	public function desc(){
		$echoType = $this->db->Type($this->type);
		if($echoType == 'weigh'){
			echo '<p>' . $echoType . ' товар | ' . $this->name .
			     ', цена ' .  ' за ' . $this->weigh .
			     'кг. По ' . $this->price .
			     'руб. за 1 кг. Итого: '. $this->Price() .'</p><br>';
			return;
		}
		echo $echoType . ' товар | ' . $this->name . ', цена = ' . $this->Price() . '<br>';
	}


}
