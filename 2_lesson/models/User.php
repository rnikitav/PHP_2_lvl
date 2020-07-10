<?php

namespace App\models;
class User extends Model
{
	public $id;
	public $name;
	public $price;
	public $info;


	public function getNameTable(): string
	{
		return 'users';
	}
}
