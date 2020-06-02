<?php

namespace Frejas\Core\Database;

use PDO;

class SqliteDatabase implements DatabaseInterface {
    private string $dsn = "sqlite:" . BASE_DIR . '/db.sqlite';
    private PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO($this->dsn);
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}
