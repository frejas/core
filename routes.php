<?php

use Frejas\Core\Http\IndexController;
use Frejas\Core\Http\Middlewares\AuthenticationMiddleware;
use Frejas\Core\Http\Middlewares\AuthorizationMiddleware;
use Frejas\Core\Http\PostController;
use Frejas\Core\Http\UserController;
use Hrafn\Router\RouteBuilder;

$builder = $router->getBuilder();
$builder->get('/', IndexController::class . '@' . 'getIndex');

$builder->group('admin', static function (RouteBuilder $builder) {
    $builder->put('user/{id}', UserController::class . '@' . 'putUser');
    $builder->post('user', UserController::class . '@' . 'postUser');
    $builder->delete('user/{id}', UserController::class . '@' . 'deleteUser');

    $builder->put('post/{slug}', PostController::class . '@' . 'putPost');
    $builder->post('post', PostController::class . '@' . 'postPost');
    $builder->delete('post/{slug}', PostController::class . '@' . 'deletePost');

}, [
    new AuthenticationMiddleware(),
    new AuthorizationMiddleware()
]);


$builder->get('posts', PostController::class . '@' . 'getPosts');
$builder->get('post/{slug}', PostController::class . '@' . 'getPost');

$builder->get('user/{id}', UserController::class . '@' . 'getUser');
$builder->get('users', UserController::class . '@' . 'getUsers');

