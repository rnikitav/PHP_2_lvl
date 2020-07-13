<?php
namespace App\models;

class User extends Model
{
    public $id;
    public $name;
    public $login;
    public $password;
    public $is_admin;

    public function getTableName(): string
    {
        return 'users';
    }

	public function getClassName(): string {
		return __CLASS__;
	}
}
