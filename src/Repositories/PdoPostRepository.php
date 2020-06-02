<?php

namespace Frejas\Core\Repositories;

use Frejas\Core\Database\DatabaseInterface;
use Frejas\Core\Models\Post;
use Jitesoft\Exceptions\Database\Entity\EntityException;
use PDO;

class PdoPostRepository implements PostRepositoryInterface {
    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $db) {
        $this->db = $db;
    }

    public function getPost(int $id): Post {
        $stmt = $this->db->getPdo()->prepare('SELECT * FROM posts WHERE id=:id');
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(Post::class);
    }

    public function getPosts(): array {
        $query = $this->db->getPdo()->query("SELECT * FROM posts");
        return $query->fetchAll(PDO::FETCH_CLASS, Post::class);
    }

    public function createPost(string $header, string $text): Post {
        $stmt = $this->db->getPdo()->prepare("INSERT INTO posts (header, text) VALUES(:header, :text)");
        $stmt->bindParam('header', $header);
        $stmt->bindParam('text', $text);
        if (!$stmt->execute()) {
            throw new EntityException();
        }
        $id = $this->db->getPdo()->lastInsertId(); // No, this is just to get this rolling!

        return $this->getPost($id);
    }
}
