<?php


namespace App\services;


use App\engine\Container;


/**
 * Class Service
 * @package App\services
 *
 */
abstract class Service
{
    /**
     * @var Container
     */
    protected $container;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

}
