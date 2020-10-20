<?php


namespace App\repositories;


use App\entities\Comments;

class CommentsRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
         return 'comments';
    }

    public function getEntityName(): string
    {
        return Comments::class;
    }

}
