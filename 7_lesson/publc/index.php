<?php

use \App\engine\App;

require_once dirname(__DIR__) . '/vendor/autoload.php';
$config = include dirname(__DIR__) . '/engine/config.php';

session_start();

echo App::call()->run($config);

