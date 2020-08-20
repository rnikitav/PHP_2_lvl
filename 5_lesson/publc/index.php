<?php

use App\controllers\UserController;
use App\services\Autoloader;
use App\services\DB;
use App\models\Good;
use App\models\User;
use App\services\RendererTmplService;
use App\services\TwigRendererService;

require_once dirname(__DIR__) . '/vendor/autoload.php';



$controller = 'user';
if (!empty($_GET['c'])){
    $controller = $_GET['c'];
}

$action = '';
if (!empty($_GET['a'])){
    $action = $_GET['a'];
}


$controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';

if (class_exists($controllerName)){
    /** @var UserController $realController     */
    $realController = new $controllerName(new TwigRendererService());
    $content = $realController->run($action);
    if (!empty($content)){
        echo $content;
    }
}




$good = new Good();
//var_dump(Good::getOne(1));
//$user = new User();
//var_dump(User::getOne(1));
//var_dump(User::getAll());
//
//
//$user = new User();
//$user->delete(58);
//$user->id = 53;
//$user->name = 'change Class dsadsasad';
//$user->login = '3 change class dsadsa';
//$user->password = '123';
//$user->save();
//var_dump($user);
//$good = new Good();
//$good->delete(19);
//$good->id = 26;
//$good->price = 3;
//$good->name = ' name ';
//$good->description = 'desc';
//$good->img = 'img';
//$good->article = 'article';
//$good->save();
//var_dump($good);

