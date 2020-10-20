<?php


namespace App\engine;

use App\controllers\BasketController;
use App\controllers\Controller;
use App\controllers\LoginController;
use App\controllers\RegistrationController;
use App\controllers\ShopController;
use App\controllers\UserController;
use App\repositories\BasketRepository;
use App\repositories\CommentsRepository;
use App\repositories\GoodRepository;
use App\repositories\OrderRepository;
use App\repositories\RegistrationRepository;
use App\repositories\Repository;
use App\repositories\UserRepository;
use App\services\AuthService;
use App\services\BasketService;
use App\services\DB;
use App\services\GoodService;
use App\services\LoginService;
use App\services\OrderService;
use App\services\PaginatorService;
use App\services\RegistrationService;
use App\services\Request;
use App\traits\TSingleton;
use App\services\TwigRendererService;
use App\services\RendererTmplService;

/**
 * Class App
 * @package App\engine
 *
 * @property Request $request
 * @property DB $db
 * @property TwigRendererService $renderer
 * @property GoodRepository $goodRepository
 * @property BasketRepository $basketRepository
 * @property CommentsRepository $commentsRepository
 * @property RegistrationRepository $registrationRepository
 * @property Repository $repository
 * @property UserRepository $userRepository
 * @property OrderRepository $orderRepository
 * @property BasketService $basketService
 * @property GoodService $goodService
 * @property LoginService $loginService
 * @property PaginatorService $paginatorService
 * @property RegistrationService $registrationService
 * @property AuthService $authService
 * @property OrderService $orderService
 */
class App
{
    use TSingleton;

    protected $config = [];
    /**
     * @var Container
     */
    protected $container;

    /**
     * @return App
     */
    public static function call()
    {
        return static::getInstance();
    }
    public function run($config)
    {
        $this->config = $config;
        $this->setContainer();
        return $this->runController();
    }

    public function setContainer()
    {
        $this->container = new Container($this->config['components']);
    }

    protected function runController()
    {
        $request = $this->request;


        $controllerName = $request->getControllerName();
        if (class_exists($controllerName)){
            /** @var Controller $realController     */
            $realController = new $controllerName(
                $this,
                $request
            );
            return $realController->run($request->getActionName());
        }
        return 'Error 404';
    }
    public function __get($name)
    {
        return $this->container->$name;
    }

}
