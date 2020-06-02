<?php

namespace Frejas\Core\Http;

use Frejas\Core\Models\User;
use Frejas\Core\Repositories\UserRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends Controller {
    private UserRepositoryInterface $userRepository;


    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getUser(int $id) {
        return $this->json(200, [ 'name' => ($this->userRepository->getUser($id)->name)]);
    }

    public function getUsers() {
        $all = $this->userRepository->getUsers();
        return $this->json(200, array_map(fn(User $u) => ['name' => $u->name], $all));
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
