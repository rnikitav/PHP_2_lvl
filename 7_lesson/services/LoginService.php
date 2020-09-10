<?php


namespace App\services;


use App\entities\User;
use App\repositories\UserRepository;

class LoginService extends Service
{
    private $sol = 'zxcvbn';

    public function logIn($arrFromPost)
    {
        if (empty($arrFromPost['login']) || empty($arrFromPost['password'])){
            return 'Вы ввели не все данные';
        }
        $frontLogin = strip_tags(trim($arrFromPost['login']));
        $passwordFront = password_hash(md5($arrFromPost['password'] . $this->sol), PASSWORD_DEFAULT);
        $loginUser = $this->container->userRepository->getOneByLogin($frontLogin);
        if (empty($loginUser)){
            return 'Нет такого пользователя';
        }
        if (password_verify($loginUser->password, $passwordFront)) {
            $_SESSION['Login'] = true;
            unset($loginUser->password);
            $_SESSION['user'] = $loginUser;
            return header("Location: /user/one/?id={$loginUser->id}");
        }
        return 'Вы ввели неверный пароль';
    }

}
