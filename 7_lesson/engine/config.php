<?php
return [

    'name' => 'Интернет магазин',
    'defaultController' => 'user',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'dbname' => 'lesson6',
                'charset' => 'UTF8',
                'user' => 'root',
                'password' => 'root0987'
            ],
        ],
        'request' => [
            'class' => \App\services\Request::class,
        ],
        'renderer' => [
            'class' => \App\services\TwigRendererService::class,
        ],
        'goodRepository' => [
            'class' => \App\repositories\GoodRepository::class,
        ],
        'basketRepository' => [
            'class' => \App\repositories\BasketRepository::class,
        ],
        'commentsRepository' => [
            'class' => \App\repositories\CommentsRepository::class,
        ],
        'registrationRepository' => [
            'class' => \App\repositories\RegistrationRepository::class,
        ],
        'repository' => [
            'class' => \App\repositories\Repository::class,
        ],
        'userRepository' => [
            'class' => \App\repositories\UserRepository::class,
        ],
        'orderRepository' => [
            'class' => \App\repositories\OrderRepository::class,
        ],

        'basketService' => [
            'class' => \App\services\BasketService::class,
        ],
        'goodService' => [
            'class' => \App\services\GoodService::class,
        ],
        'loginService' => [
            'class' => \App\services\LoginService::class,
        ],
        'paginatorService' => [
            'class' => \App\services\PaginatorService::class,
        ],
        'registrationService' => [
            'class' => \App\services\RegistrationService::class,
        ],
        'authService' => [
            'class' => \App\services\AuthService::class,
        ],
        'orderService' => [
            'class' => \App\services\OrderService::class,
        ],
    ]
];
