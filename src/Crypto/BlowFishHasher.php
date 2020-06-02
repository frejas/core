<?php

namespace Frejas\Core\Crypto;

use Frejas\Core\Contracts\HashInterface;

class BlowFishHasher implements HashInterface {
    public function hash(string $value): string {
        $value = password_hash($value, PASSWORD_BCRYPT);
        if ($value !== null && $value !== false) {
            return $value;
        }

        throw new \Exception("Failed to hash the given value.");
    }

    public function validate(string $value, string $hash): bool {
        return password_verify($value, PASSWORD_BCRYPT);
    }
}
