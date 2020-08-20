<?php


namespace App\repositories;


use App\entities\User;

class RegistrationRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return 'users';
    }

    public function getEntityName(): string
    {
        return User::class;
    }
}
