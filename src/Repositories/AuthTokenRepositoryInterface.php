<?php

namespace Frejas\Core\Repositories;

use Frejas\Core\Models\AuthToken;

interface AuthTokenRepositoryInterface {

    public function create(int $userId): AuthToken;
    public function getToken(string $token): AuthToken;
    public function getTokens(int $userId): array;

}
