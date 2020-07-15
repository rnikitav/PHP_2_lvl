<?php


namespace App\models;


class Comments extends Model
{
    public $id;
    public $article;
    public $comment;


    /**
     * @inheritDoc
     */
    public static function getTableName(): string
    {
        return 'comments';
    }

    public static function getClassName(): string
    {
        return __CLASS__;
    }
}
