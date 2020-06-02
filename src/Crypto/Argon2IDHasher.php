<?php

namespace Frejas\Core\Crypto;

use Frejas\Core\Contracts\HashInterface;

class Argon2IDHasher implements HashInterface {

    public function hash(string $value): string {
        $value = password_hash($value, PASSWORD_ARGON2ID);
        if ($value !== null && $value !== false) {
            return $value;
        }
        throw new \Exception("Failed to hash the given value.");
    }

    public function validate(string $value, string $hash): bool {
        return password_verify($value, $hash);
    }
}
