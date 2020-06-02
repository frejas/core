<?php

namespace Frejas\Core\Repositories;

use Frejas\Core\Models\Post;

interface PostRepositoryInterface {
    public function getPost(int $id): Post;
    public function getPosts(): array;
    public function createPost(string $header, string $text): Post;
}
