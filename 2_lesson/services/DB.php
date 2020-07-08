<?php

namespace App\services;

/**
 * Class DB
 * Получать из БД данные
 * @package App\services
 */
class DB implements IDB
{
	public function find($sql)
	{
		return $sql;
	}
	public function findAll($sql)
	{
		return $sql;
	}
	public function Type($name){
		if ($name == 'Цифровой'){
			return 'Digital цена в два раза дешевле';
		}
		if ($name == 'Реальный') {
			return 'Real';
		}
		if ($name == 'Весовой') {
			return 'weigh';
		}
		return 'undefined';
	}


	public function myMoney($totalSum, $percent ) {
		return 'Наша прибыль: ' . ($totalSum/100) * $percent . 'р <hr>';
	}
}
