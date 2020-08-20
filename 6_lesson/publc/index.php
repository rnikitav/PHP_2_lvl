<?php

use App\controllers\Controller;
//use App\controllers\UserController;
use App\services\RendererTmplService;
use App\services\Request;
use App\services\TwigRendererService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

session_start();
$request = new Request();


$controllerName = $request->getControllerName();
if (class_exists($controllerName)){
    /** @var Controller $realController     */
    $realController = new $controllerName
    (new TwigRendererService(),
    $request
    );
    $content = $realController->run($request->getActionName());
    if (!empty($content)){
        echo $content;
    }
}


