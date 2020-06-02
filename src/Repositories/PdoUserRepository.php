<?php

namespace Frejas\Core\Repositories;

use Frejas\Core\Database\DatabaseInterface;
use Frejas\Core\Models\User;
use Jitesoft\Exceptions\Database\Entity\EntityException;
use PDO;

class PdoUserRepository implements UserRepositoryInterface {
    private $db;

    public function __construct(DatabaseInterface $database) {
        $this->db = $database;
    }

    public function getUser(int $id): ?User {
        $stmt = $this->db->getPdo()->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            throw new EntityException(json_encode([$id, $stmt->errorInfo()]));
        }

        return $stmt->fetchObject(User::class);
    }

    public function createUser(string $name, string $password): User {
        $stmt = $this->db->getPdo()->prepare("INSERT INTO users (name, password) VALUES(:name, :password)");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('password', $password);
        if (!$stmt->execute()) {
            throw new EntityException();
        }
        $id = $this->db->getPdo()->lastInsertId(); // No, this is just to get this rolling!

        return $this->getUser($id);
    }

    public function getUsers(): array {
        $query = $this->db->getPdo()->query("SELECT * FROM users");
        return $query->fetchAll(PDO::FETCH_CLASS, User::class);
    }
}
