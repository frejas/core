<?php

namespace Frejas\Core;

use Exception;
use Frejas\Core\Contracts\ExceptionHandlerInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Hrafn\Router\Router;
use Jitesoft\Container\Container;
use Jitesoft\Log\StdLogger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class App {
    private ContainerInterface $container;
    private Router $router;

    protected function loadConfiguration() {
        $config = (fn () => require BASE_DIR . '/config/bindings.php')();
        foreach ($config['middleware'] as $middleware) {
            $this->container[$middleware] = $middleware;
        }

        foreach ($config['bindings'] as $abstract => $concrete) {
            $this->container[$abstract] = $concrete;
        }
    }

    public function __construct() {
        $this->container = new Container([
            LoggerInterface::class => new StdLogger()
        ]);
        $this->loadConfiguration();
        $this->router = new Router($this->container);
        (fn (&$router) => require BASE_DIR . '/routes.php')($this->router);
    }

    public function handle(ServerRequest $request) {
        try {
            return $this->router->handle($request);
        } catch (Exception $ex) {
            if ($this->container->has(ExceptionHandlerInterface::class)) {
                return $this->container->get(ExceptionHandlerInterface::class)->handle($ex);
            }
            return new Response(500, ['Content-Type' => 'application/json'], json_encode(['err' => $ex->getMessage()]));
        }
    }

}
