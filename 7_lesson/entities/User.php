<?php


namespace App\entities;


class User extends Entity
{
    public $id;
    public $name;
    public $login;
    public $password;
    public $is_admin;
}
