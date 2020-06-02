<?php
return [
    'middleware' => [
        \Frejas\Core\Http\Middlewares\AuthenticationMiddleware::class,
        \Frejas\Core\Http\Middlewares\AuthorizationMiddleware::class
    ],
    'services' => [

    ],
    'bindings' => [
        \Frejas\Core\Contracts\HashInterface::class => \Frejas\Core\Crypto\Argon2IDHasher::class,
        \Frejas\Core\Database\DatabaseInterface::class => \Frejas\Core\Database\SqliteDatabase::class,
        \Frejas\Core\Repositories\UserRepositoryInterface::class => \Frejas\Core\Repositories\PdoUserRepository::class,
        \Frejas\Core\Repositories\PostRepositoryInterface::class => \Frejas\Core\Repositories\PdoPostRepository::class,
        \Frejas\Core\Repositories\AuthTokenRepositoryInterface::class => \Frejas\Core\Repositories\AuthTokenRepository::class
    ]
];
