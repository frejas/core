<?php

namespace Frejas\Core\Http;

use Frejas\Core\Contracts\HashInterface;
use Frejas\Core\Models\User;
use Frejas\Core\Repositories\UserRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends Controller {
    private UserRepositoryInterface $userRepository;
    private HashInterface $hasher;

    public function __construct(UserRepositoryInterface $userRepository, HashInterface $hasher) {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
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

    public function postUser(Request $r) {
        $r = json_decode($r->getBody(), true);
        $user = $this->userRepository->createUser($r['name'], $this->hasher->hash($r['password']));
        return $this->json(200, [$user]);
    }

    public function deleteUser(string $id) {
        return $this->json(200, ['deleteUser' => '']);
    }
}
