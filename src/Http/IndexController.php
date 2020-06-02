<?php

namespace Frejas\Core\Http;

use Frejas\Core\Contracts\HashInterface;
use Frejas\Core\Repositories\AuthTokenRepositoryInterface;
use Frejas\Core\Repositories\UserRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Jitesoft\Exceptions\Http\Client\HttpUnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexController extends Controller {
    private UserRepositoryInterface $userRepository;
    private HashInterface $hash;
    private AuthTokenRepositoryInterface $authTokenRepository;

    public function __construct(UserRepositoryInterface $userRepository, HashInterface $hash, AuthTokenRepositoryInterface $authTokenRepository) {
        $this->userRepository = $userRepository;
        $this->hash = $hash;
        $this->authTokenRepository = $authTokenRepository;
    }

    public function getIndex(): ResponseInterface {
        return $this->json(200, ["v" => '0.0.1-alpha1', 'status' => 'Not ready for production!']);
    }

    public function postLogin(Request $request) {
        $body = json_decode($request->getBody(), true);
        $user = $this->userRepository->getUser($body['id']);
        if ($user && $this->hash->validate($body['password'], $user->password)) {
            $token = $this->authTokenRepository->create($user->id);
            return $this->json(201, json_encode($token));
        }

        throw new HttpUnauthorizedException();
    }
}
