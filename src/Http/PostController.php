<?php

namespace Frejas\Core\Http;

use Frejas\Core\Models\Post;
use Frejas\Core\Repositories\PostRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ServerRequestInterface;

class PostController extends Controller {
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function getPosts() {
        return $this->json(200, $this->postRepository->getPosts());
    }

    public function getPost(int $id) {
        return $this->json(200, [$this->postRepository->getPost($id)]);
    }

    public function putPost(ServerRequestInterface $r, string $slug) {
        return $this->json(200, ['putPost' => $slug]);
    }

    public function postPost(Request $r) {
        $r = json_decode($r->getBody(), true);
        $post = $this->postRepository->createPost($r['header'], $r['text']);
        return $this->json(201, $post);
    }

    public function deletePost(ServerRequestInterface $r, string $slug) {
        return $this->json(200, ['deletePost' => $slug]);
    }
}
