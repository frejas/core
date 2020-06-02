<?php

namespace Frejas\Core\Repositories;

use Frejas\Core\Models\User;

interface UserRepositoryInterface {
    public function getUser(int $id): ?User;
    public function createUser(string $name, string $password): User;
    public function getUsers(): array;
}
