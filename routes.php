<?php

use Frejas\Core\Http\IndexController;

$builder = $router->getBuilder();
$builder->get('/', IndexController::class . '@' . 'getIndex');
