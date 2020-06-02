<?php

namespace Frejas\Core\Http\Middlewares;

use Frejas\Core\Repositories\AuthTokenRepositoryInterface;
use Jitesoft\Exceptions\Http\Client\HttpUnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface {
    private AuthTokenRepositoryInterface $authTokenRepository;
    public function __construct(AuthTokenRepositoryInterface $authTokenRepository) {
        $this->authTokenRepository = $authTokenRepository;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        if (!$request->hasHeader('Authorization')) {
            throw new HttpUnauthorizedException();
        }

        $authHeader = $request->getHeader('Authorization')[0];
        $token = $this->authTokenRepository->getToken($authHeader);
        if ($token === null) {
            throw new HttpUnauthorizedException();
        }

        return $handler->handle($request);
    }
}

