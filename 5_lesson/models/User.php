<?php
namespace App\models;

class User extends Model
{
    public $id;
    public $name;
    public $login;
    public $password;
    public $is_admin;

    public static function getTableName(): string
    {
        return 'users';
    }

	public static function getClassName(): string {
		return __CLASS__;
	}

    public function __toString()
    {
        $content = [];
        foreach ($this as $one => $value){
            if ($one == 'password' || $one == 'is_admin'){
                continue;
            }
            $content[$one] = $value;
        }
        $content= json_encode($content);
        return $content;
    }
}
