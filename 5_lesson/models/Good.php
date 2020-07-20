<?php

namespace App\models;

class Good extends Model
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $img;
    public $article;
    public $comments;

    public static function getTableName(): string
    {
        return 'goods';
    }

	public static function getClassName(): string {
		return __CLASS__;
	}


}
