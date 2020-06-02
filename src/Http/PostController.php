<?php

namespace Frejas\Core\Http;

use Frejas\Core\Models\Post;
use Psr\Http\Message\ServerRequestInterface;

class PostController extends Controller {
    public function getPosts() {
        return $this->json(200, ['getPosts' => '']);
    }

    public function getPost(string $slug) {
        return $this->json(200, ['getPost' => $slug]);
    }

    public function putPost(ServerRequestInterface $r, string $slug) {
        return $this->json(200, ['putPost' => $slug]);
    }

    public function postPost(ServerRequestInterface $r) {
        return $this->json(200, ['postPost' => '']);
    }

    public function deletePost(ServerRequestInterface $r, string $slug) {
        return $this->json(200, ['deletePost' => $slug]);
    }
}
