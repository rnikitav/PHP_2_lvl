<?php


namespace App\services;


use App\entities\User;
use App\repositories\RegistrationRepository;

class RegistrationService
{
    private $sol = 'zxcvbn';

    public function register($arrFromPost)
    {
        if (empty($arrFromPost['login'])) {

            return 'Вы ввели некорректный логин';
        }
        if (empty($arrFromPost['password'])) {

            return 'Вы ввели некорректный пароль';
        }
        $frontLogin = $arrFromPost['login'];
        $name = $frontLogin;
        $passwordFront = $arrFromPost['password'];
        $repo = new RegistrationRepository();
        $alreadyExistLogin = $repo->getOneByLogin($frontLogin);
        if (!empty($alreadyExistLogin)) {
            return 'Пользователь с таким логином уже существует';
        }
        $userForAdd = new User();
        $userForAdd->login = $frontLogin;
        $userForAdd->name = $name;
        $userForAdd->password = md5($passwordFront . $this->sol);
        $res = $repo->save($userForAdd);
        if (!$res) {
            return 'Пользователь не добавлен. Что-то пошло не так(';
        }
        unset($res->password);
        unset($res->is_admin);
        return $this->getAccess($res);
    }

    protected function getAccess($dataUser)
    {
        if ($_SESSION['Login'] == true){
            session_destroy();
            session_start();
        }
        $_SESSION['Login'] = true;
        $_SESSION['user'] = $dataUser;
        return header("Location: /user/one/?id={$dataUser->id}");
    }
}
