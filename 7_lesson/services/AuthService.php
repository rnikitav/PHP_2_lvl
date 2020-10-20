<?php


namespace App\services;


class AuthService extends Service
{
    public function isAdmin($user){
        if (!$user){
            return 0;
        }
        $login = $user->login;
        $res = $this->container->userRepository->getOneByLogin($login);
        if ($res){
            return $res->is_admin;
        }
        return 0;
    }
}
