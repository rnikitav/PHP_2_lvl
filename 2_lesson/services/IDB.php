<?php


namespace App\services;


interface IDB {


	public function find($sql);

	public function findAll($sql);

	public function Type($name);

	public function myMoney($totalMoney, $percent);

}
