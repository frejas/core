<?php

namespace Frejas\Core\Repositories;

use DateTime;
use Frejas\Core\Database\DatabaseInterface;
use Frejas\Core\Models\AuthToken;
use PDO;

class AuthTokenRepository implements AuthTokenRepositoryInterface {
    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $db) {
        $this->db = $db;
    }

    public function create(int $userId): AuthToken {
        $stmt = $this->db->getPdo()->prepare('INSERT INTO auth_tokens (user_id, token, ttl) VALUES (:user_id, :token, :ttl)');
        $stmt->bindParam('user_id', $userId);

        $bytes = random_bytes(200);
        $token = substr(bin2hex($bytes), 0, 128);
        $dt = new \DateTime();
        $dt->setTimestamp((new DateTime())->getTimestamp() + 3600); // 1 full hour!
        $stmt->bindParam('token', $token);
        $ts = $dt->getTimestamp();
        $stmt->bindParam('ttl', $ts, PDO::PARAM_INT);
        $stmt->execute();
        $newToken = new AuthToken();
        $newToken->token = $token;
        $newToken->ttl = $ts;
        $newToken->userId = $userId;
        return $newToken;
    }

    public function getTokens(int $userId): array {
        $stmt = $this->db->getPdo()->prepare('SELECT * FROM auth_tokens WHERE user_id=:id AND TIMESTAMP > CURRENT_TIMESTAMP');
        $stmt->bindParam('user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, AuthToken::class);
    }

    public function getToken(string $token): AuthToken {
        $stmt = $this->db->getPdo()->prepare('SELECT * FROM auth_tokens WHERE token=:token');
        $stmt->bindParam('token', $token);
        $stmt->execute();
        return $stmt->fetchObject(AuthToken::class);
    }
}
