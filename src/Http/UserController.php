<?php

namespace Frejas\Core\Http;

use Psr\Http\Message\ServerRequestInterface;

class UserController extends Controller {

    public function getUser(string $id) {
        return $this->json(200, ['getUser' => $id]);
    }

    public function getUsers() {
        return $this->json(200, ['getUsers' => '']);
    }

    public function putUser(ServerRequestInterface $r, string $id) {
        return $this->json(200, ['putUser' => $id]);
    }

    public function postUser(ServerRequestInterface $r) {
        return $this->json(200, ['postUser' => '']);
    }

    public function deleteUser(string $id) {
        return $this->json(200, ['deleteUser' => '']);
    }
}
