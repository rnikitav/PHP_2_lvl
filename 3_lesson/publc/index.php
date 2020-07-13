<?php
use App\services\Autoloader;
use App\services\DB;
use App\models\Good;
use App\models\User;

include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([(new Autoloader()), 'loadClass']);


//$good = new Good();
//var_dump($good->getOne(1));
//$user = new User();
//var_dump($user->getOne(1));
//var_dump($good->getAll());
//
//
$user = new User();
//$user->delete(54);
//$user->id = 53;
//$user->name = 'DELETE FROM `users` WHERE `users`.`id` = 42';
//$user->login = 'FOR del';
//$user->password = 'for del';
//$user->save();
$good = new Good();
$good->delete(17);
//$good->id = 16;
//$good->price = 32;
//$good->name = 'LAST';
//$good->description = 'LAST';
//$good->save();

