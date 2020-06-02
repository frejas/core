<?php

namespace Frejas\Core\Database;

use PDO;

interface DatabaseInterface {
    public function getPdo(): PDO;
}
