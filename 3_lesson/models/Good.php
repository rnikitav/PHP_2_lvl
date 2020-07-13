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

    public function getTableName(): string
    {
        return 'goods';
    }

	public function getClassName(): string {
		return __CLASS__;
	}
}
