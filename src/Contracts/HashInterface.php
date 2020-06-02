<?php

namespace Frejas\Core\Contracts;

interface HashInterface {

    /**
     * Hash a value with the specific hash implementation.
     *
     * @param string $value Value to hash.
     * @return string
     */
    public function hash(string $value): string;

    /**
     * Validate a value against a given hash.
     *
     * @param string $value Value to validate.
     * @param string $hash  Hash to test against.
     * @return bool
     */
    public function validate(string $value, string $hash): bool;
}
