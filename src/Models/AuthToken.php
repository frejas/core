<?php

namespace Frejas\Core\Models;

class AuthToken {
    public int $userId;
    public string $token;
    public int $ttl;
}
