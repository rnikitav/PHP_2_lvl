<?php

use App\models\Digital;
use App\models\Good as Good;
use App\models\Order;
use App\models\Real;
use App\models\User;
use App\models\Weigh;
use App\services\DB;

include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([(new Autoloader()), 'loadClass']);



$db = new DB();
//$good = new Order($db);
//echo $good->getOne('21');
//echo '<hr>';
//
//$good = new Good($db);
//echo $good->getOne('21');
//echo '<hr>';
//
//
//$good = new User($db);
//echo $good->getOne('21');
//
echo '<hr>';
$tov1 = new Digital('Цифровой','Телефон', 10000, $db);
$tov1->desc();
echo $tov1->MyPercent(10);
$tov2 = new Real('Реальный', 'Стол' , 3000 , $db);
$tov2->desc();
echo $tov2->MyPercent(10);
$tov3 = new Weigh('Весовой', 'Яблоки' , 300 , $db, 3);
$tov3->desc();
echo $tov3->MyPercent(10);

