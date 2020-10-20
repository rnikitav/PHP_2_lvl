<?php


namespace App\engine;

use App\repositories\BasketRepository;
use App\repositories\CommentsRepository;
use App\repositories\GoodRepository;
use App\repositories\OrderRepository;
use App\repositories\RegistrationRepository;
use App\repositories\Repository;
use App\repositories\UserRepository;
use App\services\DB;

/**
 * Class Container
 * @package App\engine
 * @property DB $db
 * @property GoodRepository $goodRepository
 * @property BasketRepository $basketRepository
 * @property OrderRepository $orderRepository
 * @property CommentsRepository $commentsRepository
 * @property RegistrationRepository $registrationRepository
 * @property Repository $repository
 * @property UserRepository $userRepository
 */
class Container
{
    protected $components = [];
    protected $componentsItems = [];

    public function __construct(array $components)
    {
        $this->components = $components;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->componentsItems)){
            return $this->componentsItems[$name];
        }
        if (empty($this->components[$name])){
            return null;
        }
        $class = $this->components[$name]['class'];
        if (!class_exists($class)){
            return null;
        }
        if (array_key_exists('config', $this->components[$name])){
            $config = $this->components[$name]['config'];
            $this->componentsItems[$name] = new $class($config);
        }else {
            $this->componentsItems[$name] = new $class();
        }

        if (method_exists($this->componentsItems[$name], 'setContainer')){
            $this->componentsItems[$name]->setContainer($this);
        }

        return$this->componentsItems[$name];
    }
}
